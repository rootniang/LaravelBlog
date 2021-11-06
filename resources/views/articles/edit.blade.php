<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editer {{ $article->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="my-5">
            @foreach ($errors->all() as $error)
                <span class="block text-red-500">{{ $error }}</span>
            @endforeach
        </div> 
        <form action="{{ route('articles.update', $article) }}" method="post" enctype="multipart/form-data" class="mt-10">
            @method('put')
            @csrf

            <x-label for="title" value="Titre de l'article" />
            <x-input id="title" name="title" value="{{ $article->title }}" />

            <x-label for="content" value="Contenu de l'article" />
            <textarea id="content" name="content">{{ $article->content }}</textarea>

            <x-label for="image" value="Image de l'article" />
            <x-input id="image" type="file" name="image" />

            <x-label for="categorie" id="categorie" />
            <select name="categorie" id="categorie">
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $article->categorie_id === $categorie->id ? 'selected' : '' }}>{{ $categorie->name }}</option>  
                @endforeach
            </select>

            <x-button style="display: block !important;" class="mt-5"> Modifier mon article</x-button>

        </form>
    
    </div>
</x-app-layout>    