<div>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        <form wire:submit.prevent="submit">
            <div class="block w-full px-3 mb-4">
                <h1 class="block uppercase tracking-wide text-grey-darker text-lg font-bold mb-2 text-center">
                    Create Listing
                </h1>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="title" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Title
                    </label>
                    <input type="text" name="title" id="title" class="appearance-none block w-full bg-grey-lighter
                        text-grey-darker border border-red rounded py-3 px-4 mb-3 required" wire:model="title">
                    @error('title')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="category" class="block tracking-wide text-grey-darker text-xs font-bold mb-2" >
                        Category
                    </label>
                    <div class="flex items-center">
                        <div class="absolute pointer-events-none pin-y pin-r flex items-center px-2 text-grey-darker">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                        <select name="categoryId" id="categoryId" class="block appearance-none w-full bg-grey-lighter border
                            border-grey-lighter text-grey-darker py-3 px-8 pr-8 rounded" wire:model="categoryId">
                            @foreach($categories as $category)
                                <option @if  ($loop->first) selected @endif  value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label for="description" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Description
                    </label>
                    <textarea name="description" id="description" class="appearance-none block w-full bg-grey-lighter
                    text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" wire:model="description"></textarea>
                    @error('description')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="online_at" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Date Online
                    </label>
                    <input type="text" name="online_at" id="online_at" class="appearance-none block w-full
                        bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" wire:model="onlineAt">
                    @error('onlineAt')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="offline_at" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Date Offline
                    </label>
                    <input type="text" name="offline_at" id="offline_at" class="appearance-none block w-full
                        bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 " wire:model="offlineAt">
                    @error('offlineAt')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="price" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Price
                    </label>
                    <input type="text" name="price" id="price" class="appearance-none block w-full bg-grey-lighter
                        text-grey-darker border border-red rounded py-3 px-4 mb-3" wire:model="price">
                    @error('price')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="currency" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Currency
                    </label>
                    <input type="text" name="currency" id="currency" class="appearance-none block w-full bg-grey-lighter
                        text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" wire:model="currency">
                    @error('currency')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="block w-full px-3">
                <h2 class="block uppercase tracking-wide text-grey-darker text-md font-bold mb-2 text-center">
                    Contact Details
                </h2>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="contact_mobile" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Mobile
                    </label>
                    <input type="text" name="contact_mobile" id="contact_mobile" class="appearance-none block w-full
                        bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" wire:model="contactMobile">
                    @error('contactMobile')<p class="text-red-600 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="contact_email" class="block tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Email
                    </label>
                    <input type="text" name="contact_email" id="contact_email" class="appearance-none block w-full
                        bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" wire:model="contactEmail">
                   <p class="text-red-600 text-xs italic">@error('contactEmail'){{ $message }}  @enderror</p>
                </div>
            </div>
            <div class="flex justify-between mt-4">
                <div>
                    <input type="submit" wire:click="redirectToHome" value="Cancel" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"/>
                </div>
                <div>
                    <input type="submit" value="Save" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"/>
                </div>
            </div>
        </form>
    </div>
</div>
