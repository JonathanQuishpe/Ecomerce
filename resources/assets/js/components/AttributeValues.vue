<template>
    <div id="">
        <div class="tile">
            <h3 class="tile-title">Atributos</h3>
            <hr>
            <div class="tile-body">
                <div class="form-group">
                    <label class="control-label" for="value">Valor</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Ingresa el valor del atributo"
                        id="value"
                        name="value"
                        v-model="value"
                    />
                </div>
                <div class="form-group">
                    <label class="control-label" for="price">Precio</label>
                    <input
                        class="form-control"
                        type="number"
                        placeholder="Ingresa el precio del atributo"
                        id="price"
                        name="price"
                        v-model="price"
                    />
                </div>
            </div>
            <div class="tile-footer">
                <div class="row d-print-none mt-2">
                    <div class="col-12 text-right">
                        <button class="btn btn-success" type="submit" @click.stop="saveValue()" v-if="addValue">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar
                        </button>
                        <button class="btn btn-success" type="submit" @click.stop="updateValue()" v-if="!addValue">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar
                        </button>
                        <button class="btn btn-primary" type="submit" @click.stop="reset()" v-if="!addValue">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Resetear
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile">
            <h3 class="tile-title">Lista Valores</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Valor</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="value in values">
                            <td style="width: 25%" class="text-center">{{ value.id}}</td>
                            <td style="width: 25%" class="text-center">{{ value.value}}</td>
                            <td style="width: 25%" class="text-center">{{ value.price}}</td>
                            <td style="width: 25%" class="text-center">
                                <button class="btn btn-sm btn-primary" @click.stop="editAttributeValue(value)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" @click.stop="deleteAttributeValue(value)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "attribute-values",
        props: ['attributeid'],
        data() {
            return {
                values: [],
                value: '',
                price: '',
                currentId: '',
                addValue: true,
                key: 0,
            }
        },
        created: function() {
            this.loadValues();
        },
        methods: {
            loadValues() {
                let attributeId = this.attributeid;
                let _this = this;
                axios.post('/admin/attributes/get-values', {
                    id: attributeId
                }).then (function(response){
                    _this.values = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            saveValue() {
                let send = true;
                if (this.value === '' && this.price === '') {
                    send = false;
                    this.$swal("Error, Debe llenar al menos un valor del atributo.", {
                       icon: "error",
                    });
                    return;
                } 
                if(send) {
                    let attributeId = this.attributeid;
                    let _this = this;
                    axios.post('/admin/attributes/add-values', {
                        id: attributeId,
                        value: _this.value,
                        price: _this.price,
                    }).then (function(response){
                        _this.values.push(response.data);
                        _this.resetValue();
                        _this.$swal("Satisfactorio! Atributo guardado con éxito", {
                            icon: "success",
                        });
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            editAttributeValue(value) {
                this.addValue = false;
                this.value = value.value;
                this.price = value.price;
                this.currentId = value.id;
                this.key = this.values.indexOf(value);
            },
            updateValue() {
                var send = true;
                if (this.value === '' && this.price === '') {
                    send = true;
                    this.$swal("Error, Debe llenar al menos un valor del atributo.", {
                        icon: "error",
                    });
                } 
                if(send) {
                    let attributeId = this.attributeid;
                    let _this = this;
                    axios.post('/admin/attributes/update-values', {
                        id: attributeId,
                        value: _this.value,
                        price: _this.price,
                        valueId: _this.currentId
                    }).then (function(response){
                        _this.values.splice(_this.key, 1);
                        _this.resetValue();
                        _this.values.push(response.data);
                        _this.$swal("Satisfactorio! Atributo actualizado con éxito.", {
                            icon: "success",
                        });
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            deleteAttributeValue(value) {
                this.$swal({
                    title: "Está seguro?",
                    text: "Una vez borrado, usted no podrá recuperar el atributo!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.currentId = value.id;
                        this.key = this.values.indexOf(value);
                        let _this = this;
                        axios.post('/admin/attributes/delete-values', {
                            id: _this.currentId
                        }).then (function(response){
                            if (response.data.status === 'success') {
                                _this.values.splice(_this.key, 1);
                                _this.resetValue();
                                _this.$swal("Satisfacctorio! Atributo borrado con éxito!", {
                                    icon: "success",
                                });
                            } else {
                                _this.$swal("El atributo no ha sido borrado!");
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else {
                        this.$swal("Su atributo no ha sido borrado!");
                    }
                });
            },
            resetValue() {
                this.value = '';
                this.price = '';
            },
            reset() {
                this.addValue = true;
                this.resetValue();
            }
        }
    }
</script>