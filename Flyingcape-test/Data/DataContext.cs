using Flyingcape_test.Model;
using Microsoft.EntityFrameworkCore;

namespace Flyingcape_test.Data;

public class DataContext : DbContext
{
    public DataContext(DbContextOptions<DataContext> options) : base(options)
    {
    }
    
    public DbSet<CourseType> CourseTypes { get; set; }

    public DbSet<Course> Courses { get; set; }

    public DbSet<Partner> Partners { get; set; }
}