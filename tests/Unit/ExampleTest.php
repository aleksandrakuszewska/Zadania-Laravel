<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test tworzenia, wyświetlania, edycji i usuwania pojazdu.
     *
     * @return void
     */
    public function testVehicleCRUD()
    {
        // Tworzenie nowego pojazdu
        $response = $this->post('/api/vehicles', [
            'brand' => 'Test Brand',
            'model' => 'Test Model',
        ]);
        $response->assertStatus(201);

        // Pobieranie pojazdu
        $vehicleId = $response->json('data.id');
        $response = $this->get("/api/vehicles/{$vehicleId}");
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $vehicleId,
                'brand' => 'Test Brand',
                'model' => 'Test Model',
            ]
        ]);

        // Edycja pojazdu
        $response = $this->put("/api/vehicles/{$vehicleId}", [
            'brand' => 'Updated Brand',
            'model' => 'Updated Model',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $vehicleId,
                'brand' => 'Updated Brand',
                'model' => 'Updated Model',
            ]
        ]);

        // Usuwanie pojazdu
        $response = $this->delete("/api/vehicles/{$vehicleId}");
        $response->assertStatus(204);
    }

    /**
     * Test tworzenia, wyświetlania, edycji i usuwania klienta.
     *
     * @return void
     */
    public function testCustomerCRUD()
    {
        $employeeResponse = $this->post('/api/employees', [
            'name' => 'Test Employee',
        ]);
        $employeeResponse->assertStatus(201);
        $employeeId = $employeeResponse->json('data.id');
   // Tworzenie nowego klienta z poprawnym employee_id
    $response = $this->post('/api/clients', [
        'name' => 'Test Customer',
        'employee_id' => $employeeId,
    ]);
    $response->assertStatus(201);

        // Pobieranie klienta
        $clientId = $response->json('data.id');
        $response = $this->get("/api/clients/{$clientId}");
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $clientId,
                'name' => 'Test Customer',
                // 'email' => 'test@example.com',
            ]
        ]);

        // Edycja klienta
        $response = $this->put("/api/clients/{$clientId}", [
            'name' => 'Updated Customer',
            // 'email' => 'updated@example.com',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $clientId,
                'name' => 'Updated Customer',
                // 'email' => 'updated@example.com',
            ]
        ]);

        // Usuwanie klienta
        $response = $this->delete("/api/clients/{$clientId}");
        $response->assertStatus(204);
    }

    /**
     * Test tworzenia, wyświetlania, edycji i usuwania pracownika.
     *
     * @return void
     */
    public function testEmployeeCRUD()
    {
        // Tworzenie nowego pracownika
        $response = $this->post('/api/employees', [
            'name' => 'Test Employee',

        ]);
        $response->assertStatus(201);

        // Pobieranie pracownika
        $employeeId = $response->json('data.id');
        $response = $this->get("/api/employees/{$employeeId}");
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $employeeId,
                'name' => 'Test Employee',
            ]
        ]);

        // Edycja pracownika
        $response = $this->put("/api/employees/{$employeeId}", [
            'name' => 'Updated Employee',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $employeeId,
                'name' => 'Updated Employee',
            ]
        ]);

        // Usuwanie pracownika
        $response = $this->delete("/api/employees/{$employeeId}");
        $response->assertStatus(204);
    }
}
?>
