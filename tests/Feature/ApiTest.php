<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_alergenos()
    {
        //listar alérgenos
        $this->getJson('/api/v1/alergenos')
            ->assertStatus(200)
            ->assertJsonCount(14)
            ->assertJsonStructure([
                '*' => ['id', 'nombre'],
            ]);

        //crear alérgeno
        $this->postJson('/api/v1/alergenos', ['nombre' => 'Nuevo'])
            ->assertStatus(201)
            ->assertJson(['id' => 15, 'nombre' => 'Nuevo']);

        //actualizara alérgeno
        $this->putJson('/api/v1/alergenos/15', ['nombre' => 'Cambiado'])
            ->assertStatus(200)
            ->assertJson(['id' => 15, 'nombre' => 'Cambiado']);

        //Mostrar alérgeno
        $this->getJson('/api/v1/alergenos/5')
            ->assertStatus(200)
            ->assertJson(['id' => 5, 'nombre' => 'Cacahuetes']);

        //borrar alérgeno
        $this->deleteJson('/api/v1/alergenos/15')
            ->assertStatus(204);
    }
}
