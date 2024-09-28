<a href="/category/{{$category['category']->id}}">
<li class="parent-hover py-2 px-4 @if($level !== 0) w-[250px] mx-10 @endif text-[#ff4848] relative cursor-pointer whitespace-nowrap">
    {{ $category['category']->name }}

    @if (!empty($category['children']))
    <!-- Dropdown list -->
    @if($level !== 0)
    <span class="absolute right-2">
        <i class="fa-solid fa-caret-right"></i>
    </span>
    @endif
    <ul class="child-hover z-30 absolute rounded-[2px] bg-white shadow-xl shadow-l-none @if($level === 0) top-10 left-1/2 transform -translate-x-1/2 @else top-0 left-[250px] @endif border-red-200 border-[2px solid red] hidden group-hover:block">
        @foreach ($category['children'] as $child)
        @include('components._category', ['category' => $child, 'level' => $level+1])
        @endforeach
    </ul>
    @endif
</li>
</a>
