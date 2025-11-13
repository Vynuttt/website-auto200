<?php

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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 30)->unique();
            $table->char('tracking_code', 8)->unique()->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('customer_name', 100)->nullable();
            $table->string('customer_email', 120)->nullable();
            $table->string('customer_phone', 30)->nullable();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->string('vehicle_plate', 20)->nullable();
            $table->string('vehicle_model', 60)->nullable();
            $table->foreignId('mechanic_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->datetime('scheduled_at')->nullable();
            $table->enum('source_channel', ['Web', 'Walk-in', 'Phone', 'WhatsApp'])->default('Web');
            $table->integer('sla_minutes')->default(120);
            $table->string('service_type', 100)->default('General Service');
            $table->text('notes')->nullable();
            $table->text('complaint_note')->nullable();
            $table->enum('status', [
                'Booked',
                'Checked-In',
                'In-Service',
                'Ready',
                'Completed',
                'Cancelled',
                'No-Show',
                'Converted'
            ])->default('Booked');
            $table->foreignId('work_order_id')->nullable()->constrained('work_orders')->onDelete('set null');
            $table->timestamps();
            
            // Unique constraints
            $table->unique(['vehicle_id', 'booking_date', 'booking_time'], 'vehicle_date_time_unique');
            $table->unique(['mechanic_id', 'booking_date', 'booking_time'], 'mechanic_date_time_unique');
            
            // Indexes
            $table->index('scheduled_at', 'idx_bookings_scheduled_at');
            $table->index('customer_id', 'idx_bookings_customer_id');
            $table->index('mechanic_id', 'idx_bookings_mechanic_id');
            $table->index('work_order_id', 'idx_bookings_wo');
            $table->index(['customer_id', 'booking_date'], 'idx_booking_customer_date');
            $table->index(['vehicle_id', 'booking_date'], 'idx_booking_vehicle_date');
            $table->index(['status', 'booking_date'], 'idx_booking_status_date');
            $table->index(['tracking_code', 'customer_email'], 'idx_booking_tracking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};