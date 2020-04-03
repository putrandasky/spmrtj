<template>
    <div class="w-100  ">
        <div class="pb-4 pt-2">

            <h5 class="mb-0 font-weight-bold text-primary text-center">
                <slot name="above"></slot>
            </h5>

        </div>
        <div class="w-100">
        <small>
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
