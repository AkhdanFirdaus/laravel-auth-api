<?php

use App\Models\Todo;
use App\Models\User;
use App\Models\UserCredential;

use function Pest\Laravel\postJson;
use function Pest\Laravel\withHeader;

describe('testing todo api', function () {
    it('menampilkan data todo keseluruhan', function () {
        // inisiasi database sampel
        $user = User::factory()->create();
        $userCredentials = UserCredential::factory()->emailCredential($user->email)->create();
        $todos = Todo::factory(10)->for($user)->create();

        // yang bisa mengakses todo => user yang login
        $loginResponse = postJson('/api/login', [
            'type' => 'email',
            'identifier' => $user->email,
            'password' => 'password',
        ]);

        // menampilkan data
        withHeader('Authorization', 'Bearer ' . $loginResponse->json('token'))
            ->getJson('/api/todo')
            ->assertOk();
    });

    // it('menampilkan data todo berdasarkan id', function() {

    // });

    it('membuat todo', function () {
        $user = User::factory()->create();
        $userCredentials = UserCredential::factory()->emailCredential($user->email)->create();
        $todos = Todo::factory(10)->for($user)->create();

        // yang bisa mengakses todo => user yang login
        $loginResponse = postJson('/api/login', [
            'type' => 'email',
            'identifier' => $user->email,
            'password' => 'password',
        ]);

        $token = $loginResponse->json('token');

        withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/todo', [
                'title' => 'Testing todo',
                'description' => 'Ini deskripsi todonya'
            ])
            ->assertStatus(201)
            ->assertJsonPath('title', 'Testing todo');
    });
    // it('mengubah judul todo', function() {

    // });
    // it('mengubah deskripsi todo', function() {

    // });
    // it('menyelesaikan todo', function() {

    // });
    // it('hapus todo berdasarkan identifier', function() {

    // });
});
