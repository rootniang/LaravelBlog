<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                {{ session('success') }}
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($articles as $article)
                    <div class="flex items-center">
                        <a href="{{ route('articles.edit', $article) }}" class="bg-yellow-500 px-2 py-3 block">Editer {{ $article->title }}</a>
                        <a href="#" class="bg-red-500 px-2 py-3 block"
                        onclick="event.preventDefault 
                                 document.getElementById('destroy-post-form').submit();"
                        >Supprimer {{ $article->title }}
                            <form action="{{ route('articles.destroy', $article) }}" method="post" id="destroy-post-form">
                                @csrf
                                @method('delete')
                            </form>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
