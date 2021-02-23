<template>
    <div>
        <div>
            <h1 style="color: white" >Lista de libros disponibles
            <a class="btn btn-elevate btn-primary float-right btn-circle mr-2"
               @click="modalType=true, showModal()" v-if="admin">Añadir un libro</a>
            <a class="btn btn-elevate btn-primary float-right btn-circle mr-2"
               href="/home" v-if="admin">Lista de usuarios</a>
            </h1>
        </div>

        <div class="card col-md-5 bg-primary mr-2 ml-2 mt-2" :class="{'bg-danger':book.user_id}" v-for="book in books" :key="book.id">
            <h2>Nombre: {{book.name}}
                <a class="btn btn-elevate btn-dark float-right btn-circle mr-2 mt-2"
                   @click=" useBook(book)" v-if="book.user_id < 1">Usar libro</a>
                <a class="btn btn-elevate btn-primary float-right btn-circle mr-2 mt-2"
                   @click=" setFreeBook(book)" v-if="book.user_id === user.id">Liberar libro</a>
            </h2>
            <h2>Feha de publicación: <br>{{book.publication_date}}</h2>
        </div>

        <div class="modal" tabindex="-1" role="dialog" :class="{show:modal} ">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{this.modalTitle}}</h5>
                        <button @click="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " v-model="book.name"
                                       name="name" value="" required autocomplete="name" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">Autor</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" v-model="book.author"
                                       name="author" value="" required autocomplete="author">

                            </div>
                        </div>

                        <div class="form-group row" v-if="modalType">
                            <label for="publication_date" class="col-md-4 col-form-label text-md-right">Fecha de publicacion</label>

                            <div class="col-md-6">
                                <input id="publication_date" type="date" class="form-control " v-model="book.publication_date"
                                       name="publication_date" required autocomplete="publication_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">Categoria</label>

                            <div class="col-md-6">
                                <select name="category_id" id="category_id" v-model="book.category_id" class="form-control">
                                    <option value="1">Poesia</option>
                                    <option value="2">Ciencia ficcion</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar</button>
                        <button @click="saveBook()" type="button" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                modal:0,
                modalType:'',
                modalTitle:'',
                id:0,
                books:[
                    this.name='',
                    this.email='',
                    this.created_at='',
                ],
                book: {
                    name:'',
                    author:'',
                    publication_date:'',
                    category_id:'',
                    user_id:'',
                },
                admin:'',
                available:''
            }
        },
        methods:{
            async getBooks(){
                const response=await axios.get('book');
                this.books = response.data;
            },
            async deleteUser(id){
                const response=await axios.delete('/book/'+id);
                this.getUsers();
            },
            async showModal(data={}){
                this.modal =1 ;
                if(this.modalType){
                    this.modalTitle="Añadir libro";
                    this.book.name = '';
                    this.book.author = '';
                    this.book.publication_date = '';
                    this.book.category_id = '';
                    this.book.user_id = '';
                }
                else {
                    this.modalTitle="Editar libro";
                    this.id = data.id;
                    this.book.name = data.name;
                    this.book.author = data.author;
                    this.book.publication_date = data.publication_date;
                    this.book.category_id = data.category_id;
                }
            },
            async closeModal(){
                this.modal =0 ;
            },
            async saveBook(){
                if(this.modalType) {
                    axios.post('/book',this.book);
                }
                else {
                    axios.put('/book/'+this.id,this.book);
                }
                this.closeModal();
                this.getUsers();
            },
            async useBook(data={})
            {
                this.book = data;
                this.book.user_id = this.user.id;
                axios.put('/book/'+data.id,this.book);
            },
            async setFreeBook(data={})
            {
                this.book = data;
                this.book.user_id = null;
                axios.put('/book/'+data.id,this.book);
            }
        },
        created(){
            if(this.user.user_type_id===1) {
                this.admin=true;
            }
            else {
                this.admin=false;
            }
            this.getBooks();
        },

    }
</script>

<style>
    .show{
        display: list-item;
        opacity: 1;

    }
</style>
