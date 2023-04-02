<div class="flex justify-center">
    <div class="w-6/12">
        <h1 class="my-10 text-3x1">Comments</h1>
            <!-- {{$newComment}} -->
        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <div>
            @if (session()->has('message'))
                <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <section>
            @if($image)
            <img src="{{$image}}" width="200">
            @endif
            <input type="file" id="image" wire:change="$emit('fileChoosen')">
        </section>

        <form class="my-4 flex" wire:submit.prevent="addComment">    
            <input type="text" class="w-full rounded shadow p-2 mr-2 my-2" placeholder="What's on your mind" wire:model.lazy = "newComment">
            
            <div class="py-2">
                <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
            </div>
        </form>
        @foreach($comments as $comment)
        <div class="rounded border show p-3 my-2">
            <div class="flex justify-between my-2">
                <div class="flex">
                <p class="font-bold text-lg">{{$comment->creator->name}}</p>
                <p class="mx-3 py-1 text-xs text-gray-400 font-semibold">{{$comment->created_at->diffForHumans()}}</p>
                </div>
                <i class="fas fa-times text-red-200 hover:text-red-600" wire:click="remove({{$comment->id}})"></i>
            </div>

            <p class="text-gray-800">{{$comment->body}}</p>
            @if($comment->image)
            <img src="{{$comment->imagePath}}" />
            @endif
        </div>
        @endforeach
        {{$comments->links('livewire.pagination-links')}}
    </div>
</div>
<script>
Livewire.on('fileChoosen', () => {
    let inputField = document.getElementById('image')
    let file = inputField.files[0];
    let reader = new FileReader();
    reader.onloadend = () => {
        // console.log(reader.result);
        window.livewire.emit('fileUpload', reader.result)
    }
    reader.readAsDataURL(file);
})
</script>