<?php

use Illuminate\Database\Seeder;
use App\Models\Infopage;

class StaticPageContent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = <<< HTML
        <p><strong>Маркетплейс Buy26.ru </strong>призван помочь ставропольским производителм получить дополнительный канал сбыта, выйти на новые рынки и получить дополнительную аудиторию.</p>

<p>Производитель, регистрируясь у нас на сайте, получает все возможности для продвижения своих продуктов:</p>

<ul>
	<li>отдельный веб-сайт, полностью индексируемый поисковыми системами и доступный для внешней рекламы;</li>
	<li>каталог товаров;</li>
	<li>возможность получать онлайн-заказы от своих потенциальных потребителей.</li>
</ul>
HTML;

        Infopage::create(['name' => 'Контакты', 'code' => 'contacts', 'text' => '<p>Контакты центрального офиса: Ставрополь, проспект Мира, 1</p><p>Телефон Call-центра: 8-800-888-11-22</p>']);
        Infopage::create(['name' => 'Способы оплаты', 'code' => 'payment', 'text' => '<p>Подробная информация о способах оплаты.</p>']);
        Infopage::create(['name' => 'Доставка', 'code' => 'delivery', 'text' => '<p>Подробная информация о доставке.</p>']);
        Infopage::create(['name' => 'Способы оплаты', 'code' => 'payment', 'text' => '<p>Подробная информация о способах оплаты.</p>']);
        Infopage::create(['name' => 'Как заказать?', 'code' => 'howtoorder', 'text' => '<p>Подробная информация о том, как оставить заказ.</p>']);
        Infopage::create(['name' => 'Для поставщиков', 'code' => 'regvendor', 'text' => '<p>Для регистрации в роли Поставщика, просим пройти обычную регистрацию и написать нам на почтовый адрес <a href="mailto:forvendor@buy26.ru">forvendor@buy26.ru</a>.</p><p>В письме просим указать подробную информацию о Вашей компании, а также приложить логотип - для прохождения модерации.</p>']);
        Infopage::create(['name' => 'О проекте', 'code' => 'about', 'text' => $about]);
    }
}
