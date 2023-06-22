<form action="{{ route($route, $params) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus ini?');" title="{{ $title }}">{{ $detail }}</button>
</form>