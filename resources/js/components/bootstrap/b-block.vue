<template>
    <div class="block block-rounded" :class="{'block-themed': theme, 'block-fx-shadow': shadow, 'block-bordered': !shadow}">
        <div v-if="title" class="block-header" :class="[theme, {'block-header-default': !theme}]">
            <h3 class="block-title">{{ title }}</h3>
            <div v-if="hasOptionsSlot" class="block-options">
                <slot name="options"></slot>
            </div>
        </div>
        <div class="block-content" :class="{'block-content-full': full}">
            <slot name="content"></slot>
        </div>
        <div v-if="hasFooterSlot" class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        'noborder': Boolean,
        'full': Boolean,
        'shadow': Boolean,
        'title': String,
        'theme': String
    },
    computed: {
        hasOptionsSlot() {
            return !!this.$slots.options;
        },
        hasFooterSlot() {
            return !!this.$slots.footer;
        }
    }
}
</script>
