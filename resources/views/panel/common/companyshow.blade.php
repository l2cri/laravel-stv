<h1>Реквизиты</h1>

<table class="table table-striped panel">
    <tr>
        <th>Название</th>
        <td>{{ $company->name }}</td>
    </tr>
    <tr>
        <th>ОГРН</th>
        <td>{{ $company->ogrn }}</td>
    </tr>
    <tr>
        <th>ИНН</th>
        <td>{{ $company->inn }}</td>
    </tr>
    <tr>
        <th>КПП</th>
        <td>{{ $company->kpp }}</td>
    </tr>
    <tr>
        <th>Расчетный счет</th>
        <td>{{ $company->rs }}</td>
    </tr>
    <tr>
        <th>Корреспондентский счет</th>
        <td>{{ $company->ks }}</td>
    </tr>
    <tr>
        <th>БИК</th>
        <td>{{ $company->bik }}</td>
    </tr>
    <tr>
        <th>Генеральный директор</th>
        <td>{{ $company->ceo }}</td>
    </tr>
    <tr>
        <th>Телефон</th>
        <td>{{ $company->phone }}</td>
    </tr>
    <tr>
        <th>E-mail</th>
        <td>{{ $company->email }}</td>
    </tr>
    <tr>
        <th>Юридический адрес</th>
        <td>{{ $company->law_address }}</td>
    </tr>
    <tr>
        <th>Фактический адрес</th>
        <td>{{ $company->fact_address }}</td>
    </tr>
</table>