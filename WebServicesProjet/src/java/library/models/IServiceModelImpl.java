/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.models;

import java.util.Date;
import java.util.List;
import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;
import javax.persistence.Query;
import library.models.entities.Author;
import library.models.entities.Book;
import library.models.entities.Category;
import library.models.entities.LibraryUser;
import library.models.entities.Loan;

/*
* Interface IServiceModelImpl (Stateless)
*/


@Stateless(name="LIBRARYUSER")
public class IServiceModelImpl implements IServiceModel {
    
    @PersistenceContext(name="_Projet_CHEINISSE_ROMANIN_FOURNIER_FOURQUIN_TARAI")
    
    EntityManager em;

    //Author
    @Override
    public List<Author> getAllAuthors() {
        Query req=em.createQuery("select a from Author a");
        return req.getResultList();
    }

    @Override
    public Author getAuthorById(int id) {
        Long longId = new Long(id);
        Author a = em.find(Author.class, longId);
        return a;
    }

    @Override
    public void updateAuthor(Author author) {
        em.persist(author);
    }

    @Override
    public void deleteAuthor(Author author) {
        Author a = em.find(Author.class, author.getId());
        em.remove(a);
    }

    @Override
    public Author addAuthor(Author author) {
        em.persist(author);
        return author;
    }
    //End Author
    
    //Book
    @Override
    public List<Book> getAllBooks(){
        Query req=em.createQuery("select b from Book b");
        return req.getResultList();
    }
    
    @Override
    public Book getBookById(int id){
        Long longId = new Long(id);
        Book b = em.find(Book.class, longId);
        return b;
    }
    
    @Override
    public Book addBook(Book book){
        em.persist(book);
        return book;
    }
    
    @Override
    public void updateBook(Book book) {
        em.persist(book);
    }
    
    @Override
    public void deleteBook(Book book){
        Book b = em.find(Book.class, book.getId());
        em.remove(b);
    }

    @Override
    public List<Book> getBooksByCategory(Category cat) {
        Query req=em.createQuery("select b from Book b, Category c where b.id = c.id and c.id = :param");
        req.setParameter("param", cat.getId());
        return req.getResultList();
    }
    //End Book
    
    //Category
    @Override
    public List<Category> getAllCategory() {
        Query req=em.createQuery("select c from Category c");
        return req.getResultList();
    }

    @Override
    public Category getCategoryById(int id) {
        Long longId = new Long(id);
        Category c = em.find(Category.class, longId);
        return c;
    }

    @Override
    public void updateCategory(Category cat) {
        em.persist(cat);
    }

    @Override
    public void deleteCategory(Category cat) {
        Category c = em.find(Category.class, cat.getId());
        em.remove(c);
    }

    @Override
    public Category addCategory(Category cat) {
        em.persist(cat);
        return cat;
    }
    //End Category
    
    //LibraryUser
    @Override
    public List<LibraryUser> getAllLibraryUsers() {
        Query req=em.createQuery("select lu from LibraryUser lu");
        return req.getResultList();
    }

    @Override
    public LibraryUser getLibraryUserById(int id) {
        Long longId = new Long(id);
        LibraryUser lu = em.find(LibraryUser.class, longId);
        return lu;
    }

    @Override
    public void updateUser(LibraryUser user) {
        em.persist(user);
    }

    @Override
    public void deleteUser(LibraryUser user) {
        LibraryUser lu = em.find(LibraryUser.class, user.getId());
        em.remove(lu);
    }

    @Override
    public LibraryUser connect(String login, String password) {
        Query req=em.createQuery("select lu from LibraryUser lu where lu.login = :login and lu.password = :password");
        req.setParameter("login", login);
        req.setParameter("password", password);
        LibraryUser lu = null;
        try{
            lu = (LibraryUser)req.getSingleResult();
            Date date = null;
            date = new Date();
            lu.setLastConnection(date);
            updateUser(lu);
        }catch(Exception e){
            e.printStackTrace();
        }
        if(lu != null){
            return lu;
        }
        return null;
    }

    @Override
    public LibraryUser addUser(LibraryUser user) {
        em.persist(user);
        return user;
    }
    //End LibraryUser
    
    //Loan
    @Override
    public List<Loan> getListLoanByUser(int id) {
        Query req=em.createQuery("select l from Loan l, LibraryUser u where l.user = u.id and u.id = :param");
        req.setParameter("param", id);
        return req.getResultList();
    }

    @Override
    public List<Loan> getAllLoans(){
        Query req=em.createQuery("select l from Loan l");
        return req.getResultList();
    }
    
    @Override
    public void updateLoan(Loan loan) {
        em.persist(loan);
    }

    @Override
    public void deleteLoan(Loan loan) {
        Loan m = em.find(Loan.class, loan.getId());
        em.remove(m);
    }

    @Override
    public Loan addLoan(Loan loan) {
        Query req=em.createQuery("select l from Loan l where l.borrowedBook = :book and l.isReturned = false");
        req.setParameter("book", loan.getBorrowedBook());
        List<Loan> listLoans = req.getResultList();
        
        if(loan.getBorrowedBook().getQuantity() > listLoans.size()){
            em.persist(loan);
            return loan;
        }
        return null;
    }
    //End Loan

    @Override
    public Loan getLoanById(int id) {
        Long longId = new Long(id);
        Loan loan = em.find(Loan.class, longId);
        return loan;
    }
}
