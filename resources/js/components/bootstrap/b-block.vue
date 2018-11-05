<template>
    <div class="block" :class="{'block-rounded': !noround, 'block-themed': theme, 'block-fx-shadow': shadow, 'block-bordered': !shadow, 'obramowka': (theme === 'obramowka'), 'czerwonetlo': (theme === 'czerwonetlo')}">
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
        'noround': Boolean,
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

<style lang="css">
@import url('https://fonts.googleapis.com/css?family=Teko');
.block-title {
    font-family: 'Teko', sans-serif;
    font-weight: 600;
    letter-spacing: 2px;
    font-size: 2em;
    text-align: center;
}

.block.block-themed > .block-header {
    background: #d4213d;
}

.block.obramowka {
    border: 3px solid #d4213d;
}

.block.czerwonetlo {
    background: #d4213d;
    color: #fff;
}
</style>
