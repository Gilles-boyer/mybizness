export default {
    data: () => ({
    }),
    props: {
        buttons:{
            type:Array,
            required:true,
        },
        tabs:{
            type:String,
            required:true,
        }
    },
    methods:{
        changeTab(tab) {
            this.$emit('valueTab', tab);
        }
    }

}