<template>
	<div>
    <h1>home components</h1>
	</div>
</template>

<script type="text/javascript">
	export default {
  created(){
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  }
}
</script>

<style type="text/css">
	
</style> 