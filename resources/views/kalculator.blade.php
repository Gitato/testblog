<html>
<head>

</head>
<body>
{{--<form action="{{url('segmentation')}}">--}}
{{--    <a href="{{url('summation')}}" class="btn btn-primary">Summation</a>--}}
{{--    <a href="{{url('subtraction')}}" class="btn btn-primary">Subtraction</a>--}}
{{--    <a href="{{url('multiplication')}}" class="btn btn-primary">Multiplication</a>--}}
{{--    <button type="submit" class="btn btn-primary">Segmentation</button>--}}
{{--</form>--}}
{{--@if(isset($operator))--}}
<form action="{{url('kalculated')}}">
    <input type="text" name="a">
    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
{{--    {{$operator}}--}}
    <input type="text" name="b">
    <input type="submit" value="Вывод">
</form>
{{--@endif--}}
</body>
</html>
