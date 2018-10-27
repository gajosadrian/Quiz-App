<template>
    <div class="alert alert-dismissable" :class="variant" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h3 v-if="title" class="alert-heading font-size-h4 font-w400">Sukces</h3>
        <p class="mb-0">
            <slot></slot>
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            'title': String,
            'variant': String,
        }
    }
</script>
