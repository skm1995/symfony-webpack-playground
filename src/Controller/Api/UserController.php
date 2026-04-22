<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users')]
class UserController extends AbstractController
{
    #[Route('', name: 'api_users_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->json([
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'admin'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'user'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'user'],
        ]);
    }

    #[Route('/{id}', name: 'api_users_get', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        // In real app, fetch from database
        $users = [
            1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'admin'],
            2 => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'user'],
        ];

        if (!isset($users[$id])) {
            return $this->json(['error' => 'User not found'], 404);
        }

        return $this->json($users[$id]);
    }
}
