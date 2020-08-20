<template>
    <div class="container mx-auto flex min-h-screen md:flex">
        <div class="md:max-w-xs pt-20">
            <div class="col-lg-3 mb-4">

                <h3 class="mt-4 mb-4">Price</h3>
                <div class="form-check" v-for="(price, index) in prices">
                    <input class="form-check-input" type="checkbox" :value="index" :id="'price'+index" v-model="selected.prices">
                    <label class="form-check-label" :for="'price' + index">
                        {{ price.name }} ({{ price.listings_count }})
                    </label>
                </div>

                <h3 class="mt-4 mb-4">Categories</h3>
                <div class="form-check" v-for="(category, index) in categories">
                    <input class="form-check-input" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.categories">
                    <label class="form-check-label" :for="'category' + index">
                        {{ category.name }} ({{ category.listings_count }})
                    </label>
                </div>
            </div>
        </div>
        <div class="flex-1">

            <div class="w-full flex justify-center">
                <div class="w-3/4 flex rounded-full bg-white text-gray-600">
                    <input type="search" name="search" v-model="selected.search" @keyup.enter="loadAll()" placeholder="Search by title or category" class="w-full bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none">
                    <button type="button" v-on:click="loadAll()" class="flex right-0 top-0 mt-3 mr-4">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <!--<div class="w-full flex justify-center">
                <p v-if="selected.search.length > 3">Searching for {{selected.search}}</p>
            </div>-->
            <div class="flex items-center flex-wrap pt-4 pb-12">
                <div class="w-full flex flex-col" v-if="listings.length < 1">
                    <p class="text-center">No results found.</p>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col" v-for="listing in listings">
                    <a :href="route('listings.show', {listing: listing.slug})">
                        <!--<a href="">-->
                        <img class="hover:grow hover:shadow-lg rounded" :src="listing.imageUrl" :alt="listing.title + ' image'">
                        <div class="pt-3 flex items-center justify-between">
                            <p class="font-weight-bold">{{ listing.title }}</p>
                        </div>
                        <p class="pt-4 text-gray-600 text-xs font-weight-light">{{ listing.description }}</p>
                        <p class="pt-4 text-gray-900">{{ listing.price }} {{ listing.currency }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            prices: [],
            categories: [],
            listings: [],
            selected: {
                prices: [],
                categories: [],
                search: ''
            },
        }
    },
    mounted() {
        this.loadAll();
    },
    watch: {
        selected: {
            handler: function () {
                this.loadAll();
            },
            deep: true
        }
    },
    methods: {
        /**
         * Fetch listings.
         */
        loadListings: function () {
            axios.get('/api/listings', {
                params: this.selected
            })
                .then((response) => {
                    this.listings = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        /**
         * Fetch categories.
         */
        loadCategories: function () {
            axios.get('/api/categories')
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        /**
         * Fetch price ranges.
         */
        loadPrices: function () {
            axios.get('/api/listings/prices')
                .then((response) => {
                    this.prices = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadAll: function () {
            this.loadCategories();
            this.loadPrices();
            this.loadListings();
        }
    }
}
</script>
