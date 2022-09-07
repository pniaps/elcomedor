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

    public function test_ingredientes()
    {
        //listar ingredientes
        $this->getJson('/api/v1/ingredientes')
            ->assertStatus(200)
            ->assertJsonCount(86)
            ->assertJsonStructure([
                '*' => ['id', 'nombre', 'alergenos'],
            ]);

        //crear ingrediente
        $this->postJson('/api/v1/ingredientes', ['nombre' => 'Nuevo ingrediente', 'alergenos' => [1, 5]])
            ->assertStatus(201)
            ->assertJson([
                'id' => 87,
                'nombre' => 'Nuevo ingrediente',
                'alergenos' => [
                    [
                        "id" => 1,
                        "nombre" => "Gluten"
                    ],
                    [
                        "id" => 5,
                        "nombre" => "Cacahuetes"
                    ]
                ]
            ]);

        //actualizara ingrediente
        $this->putJson('/api/v1/ingredientes/87', ['nombre' => 'Ingrediente modificado', 'alergenos' => [3]])
            ->assertStatus(200)
            ->assertJson([
                'id' => 87,
                'nombre' => 'Ingrediente modificado',
                'alergenos' => [
                    [
                        "id" => 3,
                        "nombre" => "Huevos"
                    ]
                ]
            ]);

        //Mostrar ingrediente
        $this->getJson('/api/v1/ingredientes/11')
            ->assertStatus(200)
            ->assertJson([
                'id' => 11,
                'nombre' => 'Burger',
                'alergenos' => [
                    [
                        "id" => 1,
                        "nombre" => "Gluten"
                    ]
                ]
            ]);

        //borrar ingrediente
        $this->deleteJson('/api/v1/ingredientes/87')
            ->assertStatus(204);
    }
}
