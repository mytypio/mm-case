<?php

declare(strict_types=1);

namespace App\Service;

use App\Exceptions\MixPanelException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

class Mixpanel
{
    public Client $client;

    /**
     * Mixpanel constructor.
     *
     * @param string $apiToken The API token for Mixpanel.
     * @param string $apiUrl   The API URL for Mixpanel.
     */
    public function __construct(
        private readonly string $apiToken,
        private readonly string $apiUrl
    ) {
        $this->client = new Client(
            [
                'base_uri' => $this->apiUrl,
            ]
        );
    }

    /**
     * Sends a request to the Mixpanel API.
     *
     * @param  string $path    The API endpoint path.
     * @param  array  $payload The data to be sent in the request.
     * @return bool True if the request was successful.
     * @throws GuzzleException If there is an error with the HTTP request.
     * @throws MixPanelException If the Mixpanel API returns an error.
     */
    private function request(string $path, array $payload): bool
    {
        $response = $this->client->post(
            $path,
            [
            'form_params' => [
                'data' => json_encode($payload),
                'verbose' => 2,
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw MixPanelException::unknownError('An unknown error occurred.');
        }

        $content = json_decode($response->getBody()->getContents(), true);

        if (isset($content['error'])) {
            throw MixPanelException::unknownError($content['error']);
        }

        return true;
    }

    /**
     * Creates a new user in Mixpanel.
     *
     * @param  array $data The user data.
     * @return bool True if the user was successfully created.
     * @throws MixPanelException If there is an error creating the user.
     */
    public function createUser(array $data): bool
    {
        try {
            $payload = [
                '$token' => $this->apiToken,
                '$distinct_id' => $data['id'],
                'ip' => 1,
                '$set' => [
                    '$first_name' => $data['firstName'],
                    '$last_name' => $data['lastName'],
                    '$email' => $data['email'],
                    '$role' => $data['role'],
                    '$status' => $data['status'],
                ],
            ];

            $this->request(
                path: '/engage',
                payload: $payload
            );

            $this->trackUserActivity(
                id: $data['id'],
                event: 'user.created'
            );

            return true;
        } catch (GuzzleException) {
            throw MixPanelException::failedToCreate($data['id']);
        }
    }

    /**
     * Updates an existing user in Mixpanel.
     *
     * @param  array $data The user data.
     * @return bool True if the user was successfully updated.
     * @throws MixPanelException If there is an error updating the user.
     */
    public function updateUser(array $data): bool
    {
        try {
            $payload = [
                '$token' => $this->apiToken,
                '$distinct_id' => $data['id'],
                '$set' => [
                    '$first_name' => $data['firstName'],
                    '$last_name' => $data['lastName'],
                    '$email' => $data['email'],
                    '$role' => $data['role'],
                    '$status' => $data['status'],
                ],
            ];

            $this->request(
                path: '/engage',
                payload: $payload
            );

            $this->trackUserActivity(
                id: $data['id'],
                event: 'user.updated',
                changes: $data['changes']
            );

            return true;
        } catch (GuzzleException) {
            throw MixPanelException::failedToUpdate($data['id']);
        }
    }

    /**
     * Deletes a user from Mixpanel.
     *
     * @param  int $id The user ID.
     * @return bool True if the user was successfully deleted.
     * @throws MixPanelException If there is an error deleting the user.
     */
    public function deleteUser(int $id): bool
    {
        try {
            $payload = [
                '$token' => $this->apiToken,
                '$distinct_id' => $id,
                '$delete' => null,
                '$ignore_alias' => true,
            ];

            $this->request(
                path: '/engage',
                payload: $payload
            );

            $this->trackUserActivity(
                id: $id,
                event: 'user.deleted',
                changes: []
            );

            return true;
        } catch (GuzzleException) {
            throw MixPanelException::failedToDelete($id);
        }
    }

    /**
     * Tracks user activity in Mixpanel.
     *
     * @param  string $id      The user ID.
     * @param  string $event   The event name.
     * @param  array  $changes Optional changes associated with the event.
     * @return bool True if the activity was successfully tracked.
     * @throws MixPanelException If there is an error tracking the activity.
     */
    public function trackUserActivity($id, string $event, array $changes = []): bool
    {
        try {
            $this->request(
                path: '/track',
                payload: [
                    'event' => $event,
                    'properties' => [
                        'token' => $this->apiToken,
                        '$insert_id' => Str::uuid()->toString(),
                        'distinct_id' => $id,
                        'time' => time(),
                        'changes' => $changes,
                        'mp_country_code' => 'nl',
                    ],
                ]
            );

            return true;
        } catch (GuzzleException) {
            throw MixPanelException::failedToTrack($id, $event);
        }
    }
}
