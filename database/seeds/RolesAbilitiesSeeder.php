<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Ability;
use App\User;
use App\Models\Supplier;
use App\Models\Section;
use App\Models\Product\Product;

class RolesAbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * добавляем возможности
         */
        echo 'abilities';

        $a_admin = Ability::create([
            'name' => 'Доступ к админ-панели',
            'description' => 'Доступ к администриования /admin',
            'action' => 'admin',
        ]);

        $a_infopage_admin = Ability::create([
            'name' => 'Infopage администрирование',
            'description' => 'Возможность редактировать информационные страницы в админке',
            'action' => 'infopage_admin',
        ]);

        $a_supplier_panel = Ability::create([
            'name' => 'Supplier инструменты поставщика',
            'description' => 'Доступ к инструментам поставщика в Панели управления: редактирование своей компании и товаров/услуг',
            'action' => 'supplier_panel',
        ]);

        $a_section_admin = Ability::create([
            'name' => 'Категории Администрирование',
            'description' => 'Возможность редактировать и модерировать категории в админке',
            'action' => 'section_admin',
        ]);

        $a_user_panel = Ability::create([
            'name' => 'User аккаунт пользователя',
            'description' => 'Доступ к аккаунту пользователя: заказы, редактирование профилей',
            'action' => 'user_panel',
        ]);

        $a_news_admin = Ability::create([
            'name' => 'News  администрирование',
            'description' => 'News  администрирование',
            'action' => 'news_admin',
        ]);

        $a_banners_admin = Ability::create([
            'name' => 'Banners  администрирование',
            'description' => 'Администрирование баннеров',
            'action' => 'banners_admin',
        ]);

        /**
         * добавляем роли
         */
        echo 'roles';

        $r_client = Role::create([
            'name' => 'Клиент'
        ]);
        $r_client->abilities()->sync([$a_user_panel->id]);

        $r_supplier = Role::create([
            'name' => 'Поставщик'
        ]);
        $r_supplier->abilities()->sync([$a_supplier_panel->id]);

        $r_content = Role::create([
            'name' => 'Контент-менеджер'
        ]);
        $r_content->abilities()->sync([$a_banners_admin->id, $a_infopage_admin->id, $a_news_admin->id, $a_admin->id]);

        $r_moderator = Role::create([
            'name' => 'Модератор'
        ]);
        $r_moderator->abilities()->sync([$a_banners_admin->id, $a_infopage_admin->id, $a_news_admin->id, $a_admin->id, $a_section_admin->id]);

        /**
         * добавляем пользователей
         */
        echo 'users';

        $u_admin = User::create([
            'name' => 'Администратор',
            'email' => 'info@buy26.ru',
            'admin' => true,
            'password' => bcrypt('stavropol')
        ]);

        $u_supplier = User::create([
            'name' => 'Поставщик',
            'email' => 'supplier@buy26.ru',
            'password' => bcrypt('stavropol')
        ]);
        $u_supplier->roles()->sync([$r_client->id, $r_supplier->id]);

        $u_client = User::create([
            'name' => 'Клиент',
            'email' => 'client@buy26.ru',
            'password' => bcrypt('stavropol')
        ]);
        $u_client->roles()->sync([$r_client->id]);

        /**
         * добавляем поставщика
         */
        echo 'suppliers';

        $desc = <<<HTM
<p><em>Уже многие годы наша компания радует своими продуктами, граждан из разных областей России.</em></p>

<p>Невинномысский завод &ldquo;ХимПродукт&rdquo;, уже не молодое, но очень динамично развивающееся предприятие. В настоящее время завод производит лакокрасочные материалы и растворители, уксусную кислоту и уксусы, удобрения и незамерзающую жидкость для автостекол.</p>

<p>Предприятие выпускает продукцию под торговыми марками &ldquo;Невинские Уксусы&rdquo;, &ldquo;COLORIT-все для ремонта&rdquo;, COLORINI, Perlina, &ldquo;Чистое стекло&rdquo;, обладает отличными кадрами, достаточными мощностями производить быстро и качественно заявленный ассортимент своей продукции.</p>
HTM;

        $supplier = Supplier::create([
            'user_id' => $u_supplier->id,
            'name' => 'ХимПродукт',
            'code' => 'himprodukt',
            'description' => $desc,
            'conditions' => '<p>Заключается договор поставки с контрагентом, С НДС, без НДС.</p>',
            'responsibility' => '<p>Обмену и возврату не подлежит продукция,&nbsp; у которой истек срок годности, не соблюдались условия хранения заявленные производителем.</p>',
            'whosale_order' => '20000',
            'whosale_quantity' => '',
            'color' => '#f87700',
            'logo' => 'images/supplier/e3/e9/e3e9073b0f3cf0e4ee852ed938c10e40.png'
        ]);

        /**
         * добавляем категории товаров
         */

        echo 'sections';

        $potreb = Section::create([
            'name' => 'Потребительские товары',
            'code' => 'retail',
            'active' => true,
            'moderated' => true,
        ]);
        $sauce = $potreb->children()->create([
            'user_id' => $u_supplier->id,
            'name' => 'Специи, соусы, приправы',
            'code' => 'sauce',
            'active' => true,
            'moderated' => true,
        ]);

        $prom = Section::create([
            'name' => 'Промышленные товары',
            'code' => 'industry',
            'active' => true,
            'moderated' => true,
        ]);
        $him = $prom->children()->create([
            'user_id' => $u_supplier->id,
            'name' => 'Промышленная химия',
            'code' => 'him',
            'active' => true,
            'moderated' => true,
        ]);

        /**
         * добавляем товары
         */

        echo 'products';

        $desc1 = <<<HTML
<p>Уксусная кислота 70% для использования в производстве уксуса, маринадов, майонеза, горчицы, хрена и других пищевых продуктов.</p>
HTML;

        $product1 = Product::create([
            'active' => true,
            'moderated' => true,
            'available' => true,
            'featured' => true,
            'name' => 'Уксусная кислота пищевая 70%  "Невинские Уксусы" 180 г',
            'articul' => '101504',
            'barcode' => '9922',
            'unit' => 'шт',
            'length' => 50,
            'width' => 50,
            'height' => 180,
            'weight' => 350,
            'volume' => 180,
            'price' => 14,
            'regular_price' => 14,
            'whosale_price' => 13,
            'whosale_quantity' => 500,
            'preview' => 'Уксусная кислота 70%',
            'description' => $desc1,
            'supplier_id' => $supplier->id
        ]);
        $product1->sections()->sync([$sauce->id]);
        $product1->photos()->create([
            'file' => 'images/products/6d/8d/6d8d706e8df13662bf76f17de7b69c4c.jpg'
        ]);

        $desc2 = <<<HTML
<p>Растворитель марки &quot;Б&quot; предназначен для разведения масляных, нитрокрасок и лаков до рабочей консистенции.</p>
HTML;

        $product2 = Product::create([
            'active' => true,
            'moderated' => true,
            'available' => true,
            'featured' => true,
            'name' => 'Растворитель марки Б "ХимПродукт" 0,5 л ст.',
            'articul' => 'Б1',
            'barcode' => '1166',
            'unit' => 'шт',
            'length' => 65,
            'width' => 65,
            'height' => 21,
            'weight' => 750,
            'volume' => 500,
            'price' => 40,
            'regular_price' => 40,
            'whosale_price' => 36,
            'whosale_quantity' => 500,
            'preview' => 'Растворитель "Б"',
            'description' => $desc2,
            'supplier_id' => $supplier->id
        ]);
        $product2->sections()->sync([$him->id]);
        $product2->photos()->create([
            'file' => 'images/products/30/72/3072974ec1c9f77363a3b6417c79d6e3.jpg'
        ]);
    }
}
