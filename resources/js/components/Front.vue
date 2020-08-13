<template>
    <div class="container mx-auto flex min-h-screen md:flex">
        <div class="md:max-w-xs">
            <div class="col-lg-3 mb-4">
                <!--<h1 class="mt-4">Filters</h1>-->

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
            <div class="flex items-center flex-wrap pt-4 pb-12">
                <div class="w-full flex flex-col" v-if="listings.length < 1">
                    <p class="text-center">No results found.</p>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col" v-for="listing in listings">
                    <a href="#">
                        <img class="hover:grow hover:shadow-lg" src="http://placehold.it/700x400" alt="">
                        <div class="pt-3 flex items-center justify-between">
                            <p class="font-weight-bold">{{ listing.title }}</p>
                        </div>
                        <p class="pt-4 text-gray-600 text-xs font-weight-light">{{ listing.description }}</p>
                        <p class="pt-4 text-gray-900">${{ listing.price }}</p>
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
                categories: []
            }
        }
    },
    mounted() {
        this.loadCategories();
        this.loadPrices();
        this.loadListings();
    },
    watch: {
        selected: {
            handler: function () {
                this.loadCategories();
                this.loadPrices();
                this.loadListings();
            },
            deep: true
        }
    },
    methods: {
        loadCategories: function () {
            axios.get('/api/categories', {
                params: _.omit(this.selected, 'categories')
            })
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadPrices: function () {
            axios.get('/api/listings/prices', {
                params: _.omit(this.selected, 'prices')
            })
                .then((response) => {
                    this.prices = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
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
        }
    }
}
</script>
