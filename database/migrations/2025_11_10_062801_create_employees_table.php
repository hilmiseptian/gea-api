<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // penting kalau mau insert

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('department')->nullable();
            $table->decimal('salary', 10, 2)->default(0);
            $table->date('hire_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'terminated'])->default('active');
            $table->timestamps();
        });

        // Auto insert 20 employees biar si junior ga panik
        $employees = [];
        for ($i = 1; $i <= 20; $i++) {
            $employees[] = [
                'name'       => "Employee $i",
                'position'   => "Position $i",
                'department' => ['IT', 'HR', 'Finance', 'Marketing', 'Operation'][array_rand(['IT', 'HR', 'Finance', 'Marketing', 'Operation'])],
                'salary'     => rand(3000000, 15000000),
                'hire_date'  => now()->subDays(rand(30, 500)),
                'status'     => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('employees')->insert($employees);
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
