<template>
    <label :for="forLabel" >
        <slot v-if="$lang.messages[label]">{{$lang.messages[label]</slot>
        <slot v-else>{{label}}</slot>
    </label>
</template>
<script>
    export default {
        props:
            {
                forLabel:
                    {
                        type: String,
                        default: null
                    },
                label:
                    {
                        type: String,
                        default: null
                    }


            }
    }

</script>