<div class="list-group-item">
  <img class="mr-3" src="{{ $user->gravatar() }} alt={{ $user->name }}" width=32>
  <a href="{{ route('users.show', $user) }}">
    {{ $user->name }}

    @can('delete', $user)
        <form action="{{ route('users.destroy', $user) }}" method="POST" class="float-right">

          {{ csrf_field() }}
          {{ method_field('DELETE') }}

          <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>

        </form>
    @endif

  </a>
</div>
