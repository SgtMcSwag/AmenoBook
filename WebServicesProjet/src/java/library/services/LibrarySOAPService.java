/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.services;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.List;
import javax.ejb.EJB;
import javax.jws.WebParam;
import javax.jws.WebMethod;
import javax.jws.WebService;
import library.models.IServiceModel;
import library.models.entities.AccountType;
import library.models.entities.Author;
import library.models.entities.Book;
import library.models.entities.Category;
import library.models.entities.LibraryUser;
import library.models.entities.Loan;
import library.models.entities.TypeAuthor;

/*
* Classe LibrarySOAPService (WebService)
*/

@WebService
public class LibrarySOAPService {
    
    @EJB
    private IServiceModel metier;
    
    //Author
    @WebMethod
    public Author addAuthor(
        @WebParam(name="about")String about,
        @WebParam(name="birthdate")String birthdate,
        @WebParam(name="email")String email,
        @WebParam(name="firstname")String firstname,
        @WebParam(name="gender")String gender,
        @WebParam(name="lastname")String lastname,
        @WebParam(name="nationality")String nationality,
        @WebParam(name="profilepicture")String profilepicture,
        @WebParam(name="type")int type){
        
        Author author = new Author();
        author.setAbout(about);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        author.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        author.setEmail(email);
        author.setFirstName(firstname);
        author.setGender(gender);
        author.setLastName(lastname);
        author.setNationality(nationality);
        author.setProfilePicture(profilepicture);
        author.setType(TypeAuthor.values()[type]);
        metier.addAuthor(author);
        
        return author;
    }
    
    @WebMethod
    public List<Author> getAllAuthors(){
        return metier.getAllAuthors();
    }
            
            
    @WebMethod
    public Author getAuthorById(
        @WebParam(name="id")int id){
        return metier.getAuthorById(id);
    }
    
    @WebMethod
    public Author updateAuthor(@WebParam(name="id")int id,
        @WebParam(name="about")String about,
        @WebParam(name="birthdate")String birthdate,
        @WebParam(name="email")String email,
        @WebParam(name="firstname")String firstname,
        @WebParam(name="gender")String gender,
        @WebParam(name="lastname")String lastname,
        @WebParam(name="nationality")String nationality,
        @WebParam(name="profilepicture")String profilepicture,
        @WebParam(name="type")int type){
        
        Author author = metier.getAuthorById(id);
        
        author.setAbout(about);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        author.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        author.setEmail(email);
        author.setFirstName(firstname);
        author.setGender(gender);
        author.setLastName(lastname);
        author.setNationality(nationality);
        author.setProfilePicture(profilepicture);
        author.setType(TypeAuthor.values()[type]);
        metier.updateAuthor(author);
        
        return author;
        
    }
    
    @WebMethod
    public boolean deleteAuthor(@WebParam(name="id")int id){
        Author author = metier.getAuthorById(id);
        metier.deleteAuthor(author);
        return true;
    }
   //End Author
    
    //Book
    @WebMethod
    public Book addBook(@WebParam(name="isbn")String isbn,
            @WebParam(name="picture")String picture,
            @WebParam(name="publicationdate")String publicationdate,
            @WebParam(name="quantity")int quantity,
            @WebParam(name="resume")String resume,
            @WebParam(name="title")String title,
            @WebParam(name="category_id")int category_id){
        Book book = new Book();
        
        book.setIsbn(isbn);
        book.setPicture(picture);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        book.setPublicationDate(spl.parse(publicationdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        book.setQuantity(quantity);
        book.setResume(resume);
        book.setTitle(title);
        book.setCategory(metier.getCategoryById(category_id));
        
        metier.addBook(book);
        return book;
    }
    
    @WebMethod
    public List<Book> getAllBooks(){
        return metier.getAllBooks();
    }
    
    @WebMethod
    public Book getBookById(@WebParam(name="id")int id){
        return metier.getBookById(id);
    }
    
    @WebMethod
    public List<Book> getBooksByCategory(@WebParam(name="id")int id){
        Category cat = metier.getCategoryById(id);
        return metier.getBooksByCategory(cat);
    }
    
    @WebMethod
    public Book updateBook(@WebParam(name="id")int id,
            @WebParam(name="isbn")String isbn,
            @WebParam(name="picture")String picture,
            @WebParam(name="publicationdate")String publicationdate,
            @WebParam(name="quantity")int quantity,
            @WebParam(name="resume")String resume,
            @WebParam(name="title")String title,
            @WebParam(name="category_id")int category_id){
        Book book = metier.getBookById(id);
       
        book.setIsbn(isbn);
        book.setPicture(picture);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        book.setPublicationDate(spl.parse(publicationdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        book.setQuantity(quantity);
        book.setResume(resume);
        book.setTitle(title);
        book.setCategory(metier.getCategoryById(category_id));
        
        metier.updateBook(book);
        return book;
    }
    
    @WebMethod
    public boolean deleteBook(@WebParam(name="id")int id){
        Book book = metier.getBookById(id);
        metier.deleteBook(book);
        return true;
    }
    //End Book
    
    @WebMethod
    public List<Category> getAllCategory(){
        return metier.getAllCategory();
    }

    @WebMethod
    public Category getCategoryById(@WebParam(name="id")int id){
        return metier.getCategoryById(id);
    }
    
    @WebMethod
    public Category updateCategory(@WebParam(name="id")int id,
            @WebParam(name="description")String description,
            @WebParam(name="name")String name){
        Category cat = metier.getCategoryById(id);
        
        cat.setDescription(description);
        cat.setName(name);
        
        metier.updateCategory(cat);
        return cat;
    }
    
    @WebMethod
    public boolean deleteCategory(@WebParam(name="id")int id){
        Category cat = metier.getCategoryById(id);
        metier.deleteCategory(cat);
        return true;
    }
    
    @WebMethod
    public Category addCategory(@WebParam(name="description")String description,
            @WebParam(name="name")String name){
        Category cat = new Category();
        
        cat.setDescription(description);
        cat.setName(name);
        
        metier.addCategory(cat);
        return cat;
    }
    //End Category
    
    //UserLibrary
    @WebMethod
    public List<LibraryUser> getAllLibraryUsers(){
        return metier.getAllLibraryUsers();
    }
    
    @WebMethod
    public LibraryUser getLibraryUserById(@WebParam(name="id")int id){
        return metier.getLibraryUserById(id);
    }
    
    @WebMethod
    public LibraryUser updateUser(@WebParam(name="id")int id,
            @WebParam(name="accountstate")int accountstate,
            @WebParam(name="birthdate")String birthdate,
            @WebParam(name="email")String email,
            @WebParam(name="firstname")String firstname,
            @WebParam(name="gender")String gender,
            @WebParam(name="isadmin")boolean isadmin,
            @WebParam(name="lastconnection")String lastconnection,
            @WebParam(name="lastname")String lastname,
            @WebParam(name="login")String login,
            @WebParam(name="password")String password,
            @WebParam(name="profilepicture")String profilepicture){
        LibraryUser user = metier.getLibraryUserById(id);
        
        user.setAccountState(AccountType.values()[accountstate]);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setEmail(email);
        user.setFirstName(firstname);
        user.setGender(gender);
        user.setIsAdmin(isadmin);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setLastConnection(spl.parse(lastconnection));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setLastName(lastname);
        user.setLogin(login);
        user.setPassword(password);
        user.setProfilePicture(profilepicture);
        
        metier.updateUser(user);
        return user;
    }
    
    @WebMethod
    public boolean deleteUser(@WebParam(name="id")int id){
        LibraryUser user = metier.getLibraryUserById(id);
        metier.deleteUser(user);
        return true;
    }
    
    @WebMethod
    public LibraryUser connect(@WebParam(name="login")String login, @WebParam(name="password")String password){
        return metier.connect(login, password);
    }
    //End UserLibrary
    
    //Loan
    @WebMethod
    public LibraryUser addUser(@WebParam(name="accountstate")int accountstate,
            @WebParam(name="birthdate")String birthdate,
            @WebParam(name="email")String email,
            @WebParam(name="firstname")String firstname,
            @WebParam(name="gender")String gender,
            @WebParam(name="isadmin")boolean isadmin,
            @WebParam(name="lastconnection")String lastconnection,
            @WebParam(name="lastname")String lastname,
            @WebParam(name="login")String login,
            @WebParam(name="password")String password,
            @WebParam(name="profilepicture")String profilepicture){
        LibraryUser user = new LibraryUser();
        
        user.setAccountState(AccountType.values()[accountstate]);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setEmail(email);
        user.setFirstName(firstname);
        user.setGender(gender);
        user.setIsAdmin(isadmin);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setLastConnection(spl.parse(lastconnection));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setLastName(lastname);
        user.setLogin(login);
        user.setPassword(password);
        user.setProfilePicture(profilepicture);
        
        metier.addUser(user);
        return user;
    }
    
    @WebMethod
    public List<Loan> getListLoanByUser(@WebParam(name="userId")int userId){
        return metier.getListLoanByUser(userId);
    }
    
    @WebMethod
    public List<Loan> getAllLoans(){
        return metier.getAllLoans();
    }
    
    @WebMethod
    public Loan addLoan(@WebParam(name="duration")int duration,
            @WebParam(name="isreturned")boolean isreturned,
            @WebParam(name="startdate")String startdate,
            @WebParam(name="book")int book,
            @WebParam(name="libraryuser")int libraryuser){
        Loan loan = new Loan();
        
        loan.setDuration(duration);
        loan.setIsReturned(isreturned);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        loan.setStartDate(spl.parse(startdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        loan.setBorrowedBook(metier.getBookById(book));
        loan.setUser(metier.getLibraryUserById(libraryuser));
        
        loan = metier.addLoan(loan);
        return loan;
    }
    
    @WebMethod
    public Loan updateLoan(@WebParam(name="id")int id,
            @WebParam(name="duration")int duration,
            @WebParam(name="isreturned")boolean isreturned,
            @WebParam(name="startdate")String startdate,
            @WebParam(name="book")int book,
            @WebParam(name="libraryuser")int libraryuser){
        Loan loan = metier.getLoanById(id);
        
        loan.setDuration(duration);
        loan.setIsReturned(isreturned);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        loan.setStartDate(spl.parse(startdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        loan.setBorrowedBook(metier.getBookById(book));
        loan.setUser(metier.getLibraryUserById(libraryuser));
        
        metier.updateLoan(loan);
        return loan;
    }
    @WebMethod
    public boolean deleteLoan(@WebParam(name="id")int id){
        Loan loan = metier.getLoanById(id);
        metier.deleteLoan(loan);
        return true;
    }
    
    @WebMethod
    public Loan getLoanById(@WebParam(name="id")int id){
        Loan loan = null;
        loan = metier.getLoanById(id);
        return loan;
    }
    //End Loan
}
