<template>
    <div>
        <button id="delete-button" class="pl-3 btn btn-danger" @click="showDeleteConfirmation">Delete</button>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
            }
        },
        methods: {
            showDeleteConfirmation()
            {
                event.preventDefault();
                if (confirm('本当に削除しますか?'))
                {
                    let deleteForm = document.querySelector("#delete-form");
                    deleteForm.submit();
                }
                else
                {
                }
            }
        }
    }
</script>