<?php

use App\Models\Allergy;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_allergy', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Allergy::class, 'allergy_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_allergy');
    }
};
