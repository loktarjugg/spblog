<template>
    <div>
        <multiselect
                tag-placeholder="tagPlaceholder"
                placeholder="placeholder"
                :label="label"
                :track-by="trackBy"
                :options="tags"
                :value="value"
                :multiple="true"
                :taggable="true"
                :max="max"
                @tag="putTag"
                @select="handleTagSelect"
                @remove="handleTagRemove"></multiselect>
    </div>
</template>
<script>
    import {mapState, mapActions} from 'vuex'
    import Multiselect from 'vue-multiselect'
    export default{
        components: { Multiselect },

        created(){
            this.getTags( this.groups);
        },
        computed:{
            ...mapState([
                'tags'
            ])
        },
        props:{
            tagPlaceholder:{
                type:String,
                default:'创建新的标签'
            },
            placeholder:{
                type:String,
                default:'搜索或添加标签'
            },
            label:{
                type:String,
                default:'name'
            },
            trackBy:{
                type:String,
                default:'name'
            },
            value:{
                type:Array,
                default:[]
            },
            max:{
                type:Number,
                default:3
            },
            groups:{
                type:String,
                default:''
            }

        },

        methods:{
            ...mapActions([
                'getTags',
            ]),
            handleTagSelect(tag){
                this.$emit('taggle' , tag.name);
            },
            handleTagRemove(tag){
                let tags = this.value;
                for ( var t in tags){
                    if (tags[t].name == tag.name){
                        tags.splice(t,1);
                    }
                }
            },
            putTag(tag){
                var tag = {
                    name:tag
                };
                this.$store.state.tags.push(tag);
                this.handleTagSelect(tag);
            },
        },
        watch:{
            'groups':function (groups) {
                this.getTags( groups );
            }
        }

    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>