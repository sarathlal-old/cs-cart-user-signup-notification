{include file="common/letter_header.tpl"}

Hi Team,<br><br>

One new user was registerd on the store.<br><br>

{hook name="profiles:create_profile"}
{/hook}

{include file="profiles/profiles_info.tpl" created=true}

{include file="common/letter_footer.tpl"}
