<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Create new book</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Book title</label>
                            <input type="text" v-model="book.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Book author</label>
                            <input type="text" v-model="book.author" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Book ISBN</label>
                            <input type="text" v-model="book.isbn" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Book genre</label>
                            <input type="text" v-model="book.genre_id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.bookId = id;
            this.$http.get('/books/' + id)
                .then(function (resp) {
                    app.book = resp.data;
                })
                .catch(function () {
                    alert("Could not load your book")
                });
        },
        data: function () {
            return {
                bookId: null,
                book: {
                    title: '',
                    author: '',
                    isbn: '',
                    genre_id: '',
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newBook = app.book;
                this.$http.post('/books/' + app.bookId, newBook)
                    .then(function (resp) {
                        app.$router.replace('/dashboard');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create book");
                    });
            }
        }
    }
</script>

