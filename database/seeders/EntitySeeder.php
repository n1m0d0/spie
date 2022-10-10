<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entity = new Entity();
        $entity->name = "Ministerio de Relaciones Exteriores";
        $entity->acronym = "MIN-RREE";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de la Presidencia";
        $entity->acronym = "MIN-PRES";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Gobierno";
        $entity->acronym = "MIN-GOB";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Defensa";
        $entity->acronym = "MIN-DEF";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Planificación del Desarrollo";
        $entity->acronym = "MIN-PLANDE";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Economía y Finanzas Publicas";
        $entity->acronym = "MIN-ECOFIN";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Hidrocarburos y Energías";
        $entity->acronym = "MIN-HE";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Desarrollo Productivo y Economía Plural";
        $entity->acronym = "MIN-DPEP";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Obras Públicas Servicios y Vivienda";
        $entity->acronym = "MIN-OPSV";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Minería y Metalurgia";
        $entity->acronym = "MIN-MINMET";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Justicia y Transparencia Institucional";
        $entity->acronym = "MIN-JTI";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Trabajo Empleo y Previsión Socialas";
        $entity->acronym = "MIN-TEPS";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Salud y Deportes";
        $entity->acronym = "MIN-SALyD";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Medio Ambiente y Agua";
        $entity->acronym = "MIN-MAA";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Educación";
        $entity->acronym = "MIN-EDU";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Desarrollo Rural y Tierras";
        $entity->acronym = "MIN-DRT";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();

        $entity = new Entity();
        $entity->name = "Ministerio de Culturas, Descolonización y Despatriarcalización";
        $entity->acronym = "MIN-CULDESODESPA";
        $entity->type = "type1";
        $entity->guardianship = "tuicion1";
        $entity->save();
    }
}
