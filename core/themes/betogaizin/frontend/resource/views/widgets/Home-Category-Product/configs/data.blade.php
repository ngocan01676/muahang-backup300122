@php
    $categorys = get_category_type("beto_gaizin:category");

@endphp
<table class="table table-bordered">
    <tbody>
    <tr>
        <td><label for="text">{!! z_language("Title") !!}</label></td>
        <td>
            <input type="text" name="opt.name" class="form-control" placeholder="{!! z_language("Name") !!}">
        </td>
    </tr>
    <tr>
        <td><label for="text">{!! z_language("Limit") !!}</label></td>
        <td>
            <input type="text" name="opt.limit" class="form-control" placeholder="{!! z_language("Limit") !!}">
        </td>
    </tr>
    <tr>
        <td><label for="text">{!! z_language("Order By") !!}</label></td>
        <td>
            <select name="opt.order_buy" class="form-control">
                <option value="desc">Desc</option>
                <option value="asc">Asc</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for="text">{!! z_language("Category") !!}</label></td>
        <td>
            <select name="opt.category" class="form-control">
                @foreach($categorys as $category)
                    <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                @endforeach
            </select>
        </td>
    </tr>
    </tbody>
</table>