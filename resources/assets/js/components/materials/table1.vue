<template>
    <div>
        <div class="row">
            <input type="text" v-model="_filter" :class="['form-control']" :placeholder="$lang.messages['Search']"/>
                <!--<input type="text" v-model="_filter">-->
        </div>
        <div class="row">
            <table :class="['table',striped?'table-striped':'',hover?'table-hover':'']">
                <thead>
                <tr>
                    <th @click="headClick(field,key)"
                        :class="[field.sortable?'sorting':null,sortBy===key?'sorting_'+(sortDesc?'desc':'asc'):'',field.class?field.class:null]"
                        v-for="field,key in fields"

                    >
                        <slot v-if="$lang.messages[field.label]">{{$lang.messages[field.label]}}</slot>
                        <slot v-else>{{field.label}}</slot>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in _items" :key="items_key" :class="[item.state?'table-'+item.state:null]">
                    <td v-for="(field,key) in fields" :class="[field.class?field.class:null]">
                        <slot :name="key" :value="item[key]" :item="item" :index="index">{{item[key]}}</slot>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
        <div class="row">
            <div class="col-md-4">
                <u-pagination size="md" :perPage="perPage" v-model="_currentPage" :total-rows="_rows"></u-pagination>
            </div>
        </div>
        <!--<div class="row">-->
            <!--&lt;!&ndash;<u-pagination :limit="limit" size="md" :total-rows="items.length" :per-page="perPage" v-model="currentPage" ></u-pagination>&ndash;&gt;-->
        <!--</div>-->
    </div>

</template>

<script>
   import Pagination from  './pagination.vue';

    const toString = v => {
        if (!v) {
            return '';
        }

        if (v instanceof Object) {
            return Object.keys(v).map(k => toString(v[k])).join(' ');
        }

        return String(v);
    };

    const defaultSortCompare = (a, b, sortBy) => {
        return toString(a[sortBy]).localeCompare(toString(b[sortBy]), undefined, {numeric: true});
    };

    export default {
        components: {uPagination: Pagination},

        data() {
            return {
                sortBy: null,
                sortDesc: true,
                _currentPage:null,
                _rows:null,
                _filter:null,
            };
        },

        props: {
            items: {
                type: Array,
                default: () => []
            },
            fields: {
                type: Object,
                default: () => {
                }
            },
            striped: {
                type: Boolean,
                default: false
            },
            hover: {
                type: Boolean,
                default: false
            },
            perPage: {
                type: Number,
                default: null
            },
            items_key: {
                type: String,
                default: null
            },
            currentPage: {
                type: Number,
                default: 1
            },
            filter: {
                type: [String, RegExp, Function],
                default: null
            },
            sortCompare: {
                type: Function,
                default: null
            },
            itemsProvider: {
                type: Function,
                default: null
            },
            limit:
                {
                    type: Number,
                    default:3
                }
        },

        computed: {
            _items() {
                if (!this.items) {
                    return [];
                }

                if (this.itemsProvider) {
                    return this.itemsProvider(this);
                }

                let items = this.items;

                // Apply filter
                if (this.filter) {
                    if (this.filter instanceof Function) {
                        items = items.filter(this.filter);
                    } else {
                        let regex;
                        if (this.filter instanceof RegExp) {
                            regex = this.filter;
                        } else {
                            regex = new RegExp('.*' + this.filter + '.*', 'ig');
                        }
                        items = items.filter(item => regex.test(toString(item)));
                    }
                }

                // Apply Sort
                const sortCompare = this.sortCompare || defaultSortCompare;
                if (this.sortBy) {
                    items = items.sort((a, b) => {
                        const r = sortCompare(a, b, this.sortBy);
                        return this.sortDesc ? r : r * -1;
                    });
                }

                // Apply pagination
                if (this.perPage) {
                    items = items.slice((this.currentPage - 1) * this.perPage, this.currentPage * this.perPage);
                }
                 this._currentPage=this.currentPage;
                this._rows=items.length;
                return items;
            }
        },
        methods: {
            headClick(field, key) {
                if (!field.sortable) {
                    this.sortBy = null;
                    return;
                }

                if (key === this.sortBy) {
                    this.sortDesc = !this.sortDesc;
                }

                this.sortBy = key;
            }
        }
    };
</script>