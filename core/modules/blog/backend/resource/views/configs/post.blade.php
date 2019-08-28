<table class="table table-bordered">
    <tbody>
    <tr class="text-center">
        <th width="150">
            <label for="text" class="control-label">{!! z_language('Language Default') !!}</label>
        </th>
        <td>
            <div class="col-md-6 col-xs-12">
                @php
                   $language = config('zoe.language');
                @endphp
                <select name="post.language" class="form-control">
                    @foreach($language as $_language)
                    <option value="{!! $_language['lang'] !!}">{!! $_language['label'] !!}</option>
                    @endforeach
                </select>

            </div>
        </td>
    </tr>
    <tr class="text-center">
        <th width="150">
            <label for="text" class="control-label">{!! z_language('Image width') !!}</label>
        </th>
        <td>
            <div class="col-md-6 col-xs-12">
                <input type="text" class="form-control" name="post.image.width">
            </div>
        </td>
    </tr>
    <tr class="text-center">
        <th width="150">
            <label for="text" class="control-label">{!! z_language('Image height') !!}</label>
        </th>
        <td>
            <div class="col-md-6 col-xs-12">
                <input type="text" class="form-control" name="post.image.height">
            </div>
        </td>
    </tr>
    <tr class="text-center">
        <th width="150">
            <label for="text" class="control-label">{!! z_language('Image unit') !!}</label>
        </th>
        <td>
            <div class="col-md-6 col-xs-12">
                <select class="form-control" name="post.image.unit">
                    <option value="px">px</option>
                    <option value="px">em</option>
                </select>
            </div>
        </td>
    </tr>
    <tr class="text-center">
        <th width="150">
            <label for="text" class="control-label">{!! z_language('Items per page') !!}</label>
        </th>
        <td>
            <div class="col-md-6 col-xs-12">
                <input type="text" class="form-control" name="post.items_per_page">
            </div>
        </td>
    </tr>
    </tbody>
</table>