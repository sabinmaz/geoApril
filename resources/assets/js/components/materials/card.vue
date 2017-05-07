<template>
    <div :class="['card',cardVariant,cardAlign,cardInverse]">
        <!-- Card Image Slot-->
        <slot name="img" ref="img">
            <img v-if="img" :src="img" :alt="imgAlt" class="card-img">
        </slot>

        <!-- Card Header-->
        <component v-if="header || showHeader" :is="headerTag" class="card-header">
            <slot name="header">
                <slot v-if="$lang.messages[header]">{{$lang.messages[header]}}</slot>
                <slot v-else>{{header}}</slot>
            </slot>
        </component>

        <!--Show custom block when no-block prop is set-->
        <template v-if="noBlock">
            <slot></slot>
        </template>

        <!-- Card Standard Blocks-->
        <div :class="blockClass" v-else>
            <h4 v-if="title" class="card-title">
                <slot v-if="$lang.messages[title]">{{$lang.messages[title]}}</slot>
                <slot v-else>{{title}}</slot>
            </h4>
            <h6 v-if="subTitle" class="card-subtitle mb-2 text-muted" v-html="subTitle">
                <slot v-if="$lang.messages[title]">{{$lang.messages[subTitle]}}</slot>
                <slot v-else>{{subTitle}}</slot>
            </h6>
            <slot name="content"></slot>
        </div>


        <!-- Card Footer-->
        <component v-if="footer || showFooter" :is="footerTag" class="card-footer">
            <slot name="footer" v-if="$lang.messages[title]">
                <div v-html="$lang.messages[footer]"></div>
            </slot>
            <slot name="footer" v-else>
                <div v-html="footer"></div>
            </slot>
        </component>
    </div>
</template>

<script>
    export default {
        computed: {
            blockClass() {
                return [
                    'card-block',
                    this.overlay ? 'card-img-overlay' : null
                ];
            },
            cardVariant() {
                return this.variant ? `card-${this.variant}` : null;
            },
            cardInverse() {
                if (this.overlay || this.inverse) {
                    return 'card-inverse';
                }
                // Auto inverse colored cards
                if (this.inverse === null && this.variant && this.variant.length > 0 &&
                    this.variant.indexOf('outline') === -1) {
                    return 'card-inverse';
                }
            },
            cardAlign() {
                return `text-${this.align}`;
            }
        },
        props: {
            align: {
                type: String,
                default: 'left'
            },
            inverse: {
                type: Boolean,
                // It should remain null for auto inverse
                default: null
            },
            variant: {
                type: String,
                default: null
            },

            // Header
            header: {
                type: String,
                default: null
            },
            showHeader: {
                type: Boolean,
                default: false
            },
            headerTag: {
                type: String,
                default: 'div'
            },

            // Footer
            footer: {
                type: String,
                default: null
            },
            showFooter: {
                type: Boolean,
                default: false
            },
            footerTag: {
                type: String,
                default: 'div'
            },

            // Main block
            title: {
                type: String,
                default: null
            },
            subTitle: {
                type: String,
                default: null
            },
            noBlock: {
                type: Boolean,
                default: false
            },

            // Image
            img: {
                type: String,
                default: null
            },
            imgAlt: {
                type: String,
                default: null
            },
            overlay: {
                type: Boolean,
                default: false
            }
        }
    };
</script>
