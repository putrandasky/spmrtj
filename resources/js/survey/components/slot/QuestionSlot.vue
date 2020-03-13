<template>
    <div class="w-100  ">
        <b-card class="mb-3 shadow-sm">
            <h5 class="mb-0 font-weight-bold text-primary text-center">
                <slot name="above"></slot>
            </h5>
        </b-card>
        <div class="w-100">
        <small class="pt-3">
            <slot name="text"></slot>
        </small>
        </div>
        <slot name="bottom"></slot>
    </div>
</template>
<script>
export default {
    name: "QuestionSlot",
    data: function() {
        return {};
    },
    created() {},
    methods: {

    }
};
</script>
<style></style>
