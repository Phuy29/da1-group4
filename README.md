# Tutorial repo

1. Clone project 
2. Tạo nhánh mới từ main,theo format: ```"feature/fixbug"-"admin/client": <feture-name>``` - đây sẽ là nhánh chính của bạn. Ví dụ: 
```
git checkout -b feature-admin:loai_phong
```
3. Push nhánh chính của bạn lên remote repository. Ví dụ: 
```
git push origin feature-admin:loai_phong
```
4. Làm việc trên nhánh theo feature, add thay đổi, commit rồi push lên remote repository
```
git add .
git commit -m "first commit"
git push origin feature-admin:loai_phong
```
5. Code xong -> Tạo Pull request merge vào nhánh chính main
