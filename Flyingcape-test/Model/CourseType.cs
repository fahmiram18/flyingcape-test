namespace Flyingcape_test.Model;

public class CourseType
{
    public int Id { get; set; }

    public string Name { get; set; }

    public ICollection<Course> Courses { get; set; }
}