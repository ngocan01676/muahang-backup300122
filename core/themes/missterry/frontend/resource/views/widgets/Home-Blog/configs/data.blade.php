<table class="table table-bordered">
    <tbody>
    <tr>
        <td><label for="text">{!! z_language("Limit") !!}</label></td>
        <td>
            <input type="text" name="opt.limit" class="form-control" placeholder="{!! z_language("Limit") !!}">
        </td>
    </tr>
    <tr>
        <td><label for="text">{!! z_language("Category") !!}</label></td>
        <td>
            @php
                $nestables = config_get("category", "blog:category");
            @endphp
            {!! Form::CategoriesNestableOne($nestables,[],"opt.category_id") !!}
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
    </tbody>
</table>