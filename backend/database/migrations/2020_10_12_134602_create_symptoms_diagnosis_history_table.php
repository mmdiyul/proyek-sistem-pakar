<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymptomsDiagnosisHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE `symptoms_diagnosis_history` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `symptoms_id` int(11) NOT NULL,
            `diagnosis_history_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `symptoms_diagnosis_history_FK` (`symptoms_id`),
            KEY `symptoms_diagnosis_history_FK_1` (`diagnosis_history_id`),
            CONSTRAINT `symptoms_diagnosis_history_FK` FOREIGN KEY (`symptoms_id`) REFERENCES `symptoms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `symptoms_diagnosis_history_FK_1` FOREIGN KEY (`diagnosis_history_id`) REFERENCES `diagnosis_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symptoms_diagnosis_history');
    }
}
