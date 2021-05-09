# Sitvago
Hotel? Sitvago!!

### PHP Libraries Used
PHP Dot Env, Stripe, Cloudinary, Mailgun

### Project URLs
[Defunct]

### Useful Git Commands:
Check what is in the working tree (What files that you have modified/created/deleted) (Red is not added for staging yet, green is added already)  
```git status```

### Basic workflow:
1. Checkout your feature branch  
```git checkout <branchname>```

2. Code and test your feature  

3. Add (aka staging) your changes to your branch (best practice to add the files that you modified only)  To add a **SINGLE** file,  
```git add <file name>```

4. Commit your changes  
```git commit -m “<commit message>”```  
or  
```git commit``` Press enter and type the summary and description for the commit. Then press esc and type :wq  

5. Push your changes to Github 
```git push origin <branchname>``` 

### Get updates from main branch to your own branch:
1. Check out main branch  
```git checkout main```

2. Pull updates from remote main branch to local main branch    
```git pull```

3. Change back to your branch  
```git checkout <branchname>```

4. Merge main branch code to your branch  
```git merge main```

### Once the feature is completed, merge it to main branch:  
You can create a pull request in Github to merge your branch to main branch  

#### OR
*(Not recommended if you are not confident about what you are doing/unsure if your code will break anything)*
1. Checkout main branch  
```git checkout main```  

2. Merge your feature branch to main branch  
```git merge <branch>```  

3. Delete local feature branch   
```git branch -d <branchname>```  

4. Delete remote feature branch  
```git push origin --delete <branchname>```  

**Note: Best practice to commit your changes regularly**
