<template>
    <h1>logout</h1>
</template>

<script>
export default {
    name: 'logout-page',
    created() {
        this.$store.dispatch('clearTodos')
        this.$store.dispatch('destroyToken')
        .then(() => {
            this.$router.push({ name: 'home' })
        })
        .catch((error) => {
            console.log(error)
            }
        )
    }
}
</script>