<?php

namespace Tests;

use Laravel\Passport\Passport;
use Laravel\Passport\ClientRepository;

class TestHelper
{
    /**
     * Setup Passport for testing
     */
    public static function setupPassport(): void
    {
        // Create a personal access client for testing
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );

        config(['passport.personal_access_client.id' => $client->id]);
        config(['passport.personal_access_client.secret' => $client->secret]);
    }

    /**
     * Create test database tables for in-memory testing
     */
    public static function createPassportTables(): void
    {
        if (!schema()->hasTable('oauth_clients')) {
            schema()->create('oauth_clients', function ($table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->string('name');
                $table->string('secret', 100)->nullable();
                $table->string('provider')->nullable();
                $table->text('redirect');
                $table->boolean('personal_access_client');
                $table->boolean('password_client');
                $table->boolean('revoked');
                $table->timestamps();
            });
        }

        if (!schema()->hasTable('oauth_access_tokens')) {
            schema()->create('oauth_access_tokens', function ($table) {
                $table->string('id', 100)->primary();
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->unsignedBigInteger('client_id');
                $table->string('name')->nullable();
                $table->text('scopes')->nullable();
                $table->boolean('revoked');
                $table->timestamps();
                $table->dateTime('expires_at')->nullable();
            });
        }

        if (!schema()->hasTable('oauth_refresh_tokens')) {
            schema()->create('oauth_refresh_tokens', function ($table) {
                $table->string('id', 100)->primary();
                $table->string('access_token_id', 100)->index();
                $table->boolean('revoked');
                $table->dateTime('expires_at')->nullable();
            });
        }

        if (!schema()->hasTable('oauth_personal_access_clients')) {
            schema()->create('oauth_personal_access_clients', function ($table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('client_id');
                $table->timestamps();
            });
        }
    }
}

/**
 * Helper function to get schema builder
 */
function schema()
{
    return \Illuminate\Support\Facades\Schema::getFacadeRoot();
}
