<?php

use Illuminate\Database\Seeder;
use App\Anuncio;
use App\Tramite;
use App\User;
use App\Payu;
use App\Api;

use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 
        // 
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();

    	
        $admin=Role::create(['name'=>'Admin']);
        $anunciante=Role::create(['name'=>'Anunciante']);



        Payu::truncate();
        $p= new Payu;
        
        $p->API_KEY='4Vj8eK4rloUd272L48hsrarnUA';
        $p->merchantId='508029';
        $p->accountId='pRRXKOl8ikMmt9u';
        $p->urlResponse='response';
        $p->urlConfirm='confirm';
        $p->urlError='error';
        $p->urlApi='https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu';
        $p->type_encrypt='MD5';
        $p->razon_social='MI EMPRESA';
        $p->nit='1234567';
        $p->tel_contacto='123456';
        $p->type='TEST';
        $p->save();

        Api::truncate();
        $a=new Api();
        $a->nombre="GoogleDirections";
        $a->key="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjK1P7ObTN9d1kZ8LTVU-mvoY8Uc2it1w&libraries=places&callback=iniciarApp";
        $a->save();    

        User::truncate();
        $u = new User; 
        $u->truncar_detalle();
        $u->nombre="EDGAR";
        $u->email="edgar.guzman21@gmail.com";
        $u->telefono="3158790445";
        $u->codigo_referido=1;
        $u->valor_recarga=0;
        $u->status_recarga="ACTIVA";
        $u->costo_clic=0;
        $u->nota=5;
        $u->num_calificaciones=3;
        $u->password=bcrypt('123456');
        $u->save();
        $u->assignRole($anunciante);
        
        $u->agregar_horario(1,"LUNES","08:00|20:00","ABIERTO");
        $u->agregar_horario(1,"MARTES","08:00|20:00","ABIERTO");
        $u->agregar_horario(1,"MIERCOLES","08:00|20:00","ABIERTO");
        $u->agregar_horario(1,"JUEVES","08:00|20:00","ABIERTO");
        $u->agregar_horario(1,"VIERNES","08:00|20:00","ABIERTO");
        $u->agregar_horario(1,"SABADO","08:00|20:00","ABIERTO");
        $u->agregar_horario(1,"DOMINGO","08:00|20:00","ABIERTO");
        
        
        $u = new User; 
        $u->nombre="ADRIAN";
        $u->email="arian.vargas.2018@outlook.com";
        $u->telefono="311458956";
        $u->codigo_referido=2;
        $u->valor_recarga=0;
        $u->costo_clic=0;
        $u->status_recarga="ACTIVA";
        $u->nota=5;
        $u->num_calificaciones=30;
        $u->nota=0;
        $u->password=bcrypt('123456');
        $u->save();
        $u->assignRole($anunciante);
        $u->agregar_horario(2,"LUNES","08:00|20:00","ABIERTO");
        $u->agregar_horario(2,"MARTES","08:00|20:00","ABIERTO");
        $u->agregar_horario(2,"MIERCOLES","08:00|20:00","ABIERTO");
        $u->agregar_horario(2,"JUEVES","08:00|20:00","ABIERTO");
        $u->agregar_horario(2,"VIERNES","08:00|20:00","ABIERTO");
        $u->agregar_horario(2,"SABADO","08:00|20:00","ABIERTO");
        $u->agregar_horario(2,"DOMINGO","08:00|20:00","ABIERTO");
        

        $u = new User; 
        $u->nombre="Heriberto";
        $u->email="hvh3valencia@gmail.com";
        $u->telefono="3148790445";
        $u->codigo_referido=3;
        $u->valor_recarga=0;
        $u->costo_clic=0;
        $u->status_recarga="ACTIVA";
        $u->nota=3;
        $u->num_calificaciones=15;
        $u->password=bcrypt('123456');
        $u->save();
        $u->assignRole($admin);
        
        $u->agregar_horario(3,"LUNES","08:00|20:00","ABIERTO");
        $u->agregar_horario(3,"MARTES","08:00|20:00","ABIERTO");
        $u->agregar_horario(3,"MIERCOLES","08:00|20:00","ABIERTO");
        $u->agregar_horario(3,"JUEVES","08:00|20:00","ABIERTO");
        $u->agregar_horario(3,"VIERNES","08:00|20:00","ABIERTO");
        $u->agregar_horario(3,"SABADO","08:00|20:00","ABIERTO");
        $u->agregar_horario(3,"DOMINGO","08:00|20:00","ABIERTO");
        


        Tramite::truncate();
        $t=new Tramite;
        $t->nombre_tramite="PRUEBA";
        $t->descripcion="Una breve descripcion del tramite";
        $t->save();
        $t=new Tramite;
        $t->nombre_tramite="PRUEBA 2";
        $t->descripcion="Una breve descripcion del tramite";
        $t->save();
        
        Anuncio::truncate();
        $ad = new Anuncio;
        $ad->codigo_anuncio="c1";
        $ad->descripcion_anuncio="descripcion c1";
        $ad->ciudad="BOgota";
        $ad->id_tramite=1;
        $ad->valor_tramite=2000;
        $ad->id_user=1;
        $ad->save();

        $ad = new Anuncio;
        $ad->codigo_anuncio="c2";
        $ad->descripcion_anuncio="descripion c1";
        $ad->id_user=1;
        $ad->id_tramite=2;
        $ad->valor_tramite=2000;
        $ad->ciudad="BOgota";
        $ad->save();


        $ad = new Anuncio;
        $ad->codigo_anuncio="c3";
        $ad->descripcion_anuncio="descripion c3";
        $ad->id_user=2;
        $ad->id_tramite=1;
        $ad->valor_tramite=2000;
        $ad->ciudad="BOgota";
        $ad->save();

        $ad = new Anuncio;
        $ad->codigo_anuncio="c4";
        $ad->descripcion_anuncio="descripion c4";
        $ad->id_user=2;
        $ad->id_tramite=2;
        $ad->valor_tramite=2000;
        $ad->ciudad="BOgota";
        $ad->save();

        
        /*
        $t=new Tramite;
        $t->truncar_detalle();
        $ad=new Anuncio;
        $ad->asociar_tramites(1,1,10000);
        $ad->asociar_tramites(1,2,10000);
        $ad->asociar_tramites(2,1,10000);
        $ad->asociar_tramites(2,2,10000);
        $ad->asociar_tramites(3,1,10000);
        $ad->asociar_tramites(3,2,10000);
        $ad->asociar_tramites(4,1,10000);
        $ad->asociar_tramites(4,2,10000);
		*/
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
