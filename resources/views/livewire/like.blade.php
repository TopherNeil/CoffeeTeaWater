<div>
    <x-icon-button wire:click="toggleLike" icon="fas-heart" :text="$number_of_likes" :active="$isLiked" active_state="text-red-600 group-hover:text-red-300" inactive_state="text-gray-600 group-hover:text-red-600"/>
</div>
