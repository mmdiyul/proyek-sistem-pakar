<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseRulesSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE `disease_rules_symptoms` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `disease_rule_id` int(11) NOT NULL,
            `symptoms_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `disease_rules_symptoms_FK` (`disease_rule_id`),
            KEY `disease_rules_symptoms_FK_1` (`symptoms_id`),
            CONSTRAINT `disease_rules_symptoms_FK` FOREIGN KEY (`disease_rule_id`) REFERENCES `disease_rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `disease_rules_symptoms_FK_1` FOREIGN KEY (`symptoms_id`) REFERENCES `symptoms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_rules_symptoms');
    }
}
