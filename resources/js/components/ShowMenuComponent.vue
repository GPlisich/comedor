<template>
    <div>
        <el-row :gutter="24">
            <el-form ref="form" :model="form" :rules="rulesForm">
                <el-col :span="24">
                    <el-form-item label="Dia de la semana">
                        <el-date-picker
                            v-model="form.dia"
                            type="date"
                            placeholder="Elegir el dia"
                            :picker-options="pickerOptions">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="1er Menú">
                        <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Ingrese el primer menú"
                            v-model="form.menu1">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="2do Menú">
                        <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Ingrese el segundo menú"
                            v-model="form.menu2">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="3er Menú">
                        <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Ingrese el tercer menú"
                            v-model="form.menu3">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="1er Postre">
                        <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Ingrese el primer postre"
                            v-model="form.postre1">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="2er Postre">
                        <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Ingrese el segundo postre"
                            v-model="form.postre2">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="3er Postre">
                        <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Ingrese el tercer postre"
                            v-model="form.postre3">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item>
                        <el-button type="success">Crear Menú</el-button>
                    </el-form-item>
                </el-col>

            </el-form>
        </el-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form:{
                    dia:'',
                    menu1:'',
                    menu2:'',
                    menu3:'',
                    password:'',
                    postre1:'',
                    postre2:'',
                    postre3:'',
                },
                rulesForm:{
                    email:[{required: true, message: 'El email no puede estar vacio', trigger: 'blur'}],
                    password:[{required: true, message: 'La password no puede ser vacia', trigger: 'blur'}],
                },

                pickerOptions: {
                    disabledDate(time) {
                    // Función para deshabilitar los fines de semana
                    const day = time.getDay();
                    return day === 0 || day === 6; // 0 para domingo, 6 para sábado
                    },
                },
            };
        },
        created(){
            
        },
        mounted(){
            
        },
        methods: {
            
            
        },
    };
</script>

<style>

</style>