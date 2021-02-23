<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Usuarios registrados
                            <a class="btn btn-elevate btn-success float-right btn-circle"
                               @click="modalType=true, showModal()">Nuevo usuario</a>
                            <a class="btn btn-elevate btn-primary float-right btn-circle mr-2"
                               href="/books">Lista de libros</a>
                        </h2>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users" :key="user.id" >
                            <th scope="row">{{user.id}}</th>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>
                                <a class="btn btn-primary btn-elevate btn-circle btn-icon" title="Ver"
                                   href="">ver
                                </a>
                                &nbsp;
                                <a class="btn btn-warning btn-elevate btn-circle btn-icon" title="Editar"
                                   @click="modalType=false, showModal(user)">editar
                                </a>
                                &nbsp;
                                <a class="btn btn-danger btn-elevate btn-circle btn-icon"
                                   @click="deleteUser(user.id)" title="Borrar">borrar
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
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
                                    <input id="name" type="text" class="form-control " v-model="user.name"
                                           name="name" value="" required autocomplete="name" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="user.email"
                                           name="email" value="" required autocomplete="email">

                                </div>
                            </div>

                            <div class="form-group row" v-if="modalType">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control " v-model="user.password"
                                           name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_type_id" class="col-md-4 col-form-label text-md-right">Tipo de usuario</label>

                                <div class="col-md-6">
                                    <select name="user_type_id" id="user_type_id" v-model="user.user_type_id" class="form-control">
                                        <option value="2">Usuario</option>
                                        <option value="1">Administador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click="closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cerrar</button>
                            <button @click="saveUser()" type="button" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                modal:0,
                modalType:'',
                modalTitle:'',
                id:0,
                users:[
                    this.name='',
                    this.email='',
                    this.created_at='',
                ],
                user: {
                    name:'',
                    email:'',
                    password:'',
                    user_type_id:'',
                },
            }
        },
        methods:{
            async getUsers(){
                const response=await axios.get('user');
                this.users = response.data;
            },
            async deleteUser(id){
                const response=await axios.delete('/user/'+id);
                this.getUsers();
            },
            async showModal(data={}){
                this.modal =1 ;
                if(this.modalType){
                    this.modalTitle="Crear usuario";
                    this.user.name = '';
                    this.user.email = '';
                    this.user.password = '';
                    this.user.user_type_id = '';
                }
                else {
                    this.modalTitle="Editar usuario";
                    this.id = data.id;
                    this.user.name = data.name;
                    this.user.email = data.email;
                    this.user.user_type_id = data.user_type_id;
                }
            },
            async closeModal(){
                this.modal =0 ;
            },
            async saveUser(id){
                if(this.modalType) {
                    axios.post('/user',this.user);
                }
                else {
                    axios.put('/user/'+this.id,this.user);
                }
                this.closeModal();
                this.getUsers();
            },
        },
        created(){
            this.getUsers();
        },

    }
</script>
<style>
    .show{
        display: list-item;
        opacity: 1;

    }
</style>
