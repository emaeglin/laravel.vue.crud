<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createBook'}" class="btn btn-success">Create new book</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Books list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Genre</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="book, index in books">
                        <td>{{ book.title }}</td>
                        <td>{{ book.author }}</td>
                        <td>{{ book.isbn }}</td>
                        <td>{{ genres[book.genre_id] }}</td>
                        <td>
                            <router-link :to="{name: 'editBook', params: {id: book.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(book.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                books: [],
                genres: []
            }
        },
        mounted() {
            var app = this;
            this.$http.get('/books')
                .then(function (resp) {
                    app.books = resp.data.books;
                    app.genres = resp.data.genres;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load books");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    this.$http.get('/books/destroy/' + id)
                        .then(function (resp) {
                            app.books.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        }
    }
</script>
